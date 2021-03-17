/* braven_theme.js
 * New Braven Canvas cloud custom JS, as of Highlander 2020.
 * Add it here: https://braven.instructure.com/accounts/1/theme_editor
 * and be sure to keep the git version https://github.com/beyond-z/canvas-lms-js-css
 * in sync until we find an actual deploy method.
 **/

jQuery(document).ready(function($) {

  // Adds styling to the 'View Feedback' link on an uploaded file submission that has
  // been annotated by the grader. Allows the student to more easily find it.
  function styleFileUploadViewAnnotationsLink() {
    feedback_links = document.querySelectorAll('.file-upload-submission-attachment .modal_preview_link');
    feedback_links.forEach(function(link) {
      link.classList.remove('Button--link');
      link.classList.add('Button', 'Button--secondary');
    });
  }

  styleFileUploadViewAnnotationsLink();
  
});

///// Canvas Google Analytics
// Setup a UA tracking ID and configured it as described here:
// https://community.canvaslms.com/t5/Admin-Group/How-to-Set-Up-Google-Analytics-for-Canvas/ba-p/245230/page/3#comments
// Then grabbed the below JS from: https://raw.githubusercontent.com/japerks/canvas_scripts/master/updated_google_analytics_cache.js
// and swapped in our UA tracking ID at the bottom.
// Updated Aug 28, 2019
// In Google Analytics you'll need to set up custom dimensions as follows
// Custom Dimension 1 = Canvas User ID --- Scope = User
// Custom Dimension 2 = Archived --- Scope = User
// Custom Dimension 3 = Canvas User Role --- Scope = User
// Custom Dimension 4 = Canvas Course ID --- Scope = Hit
// Custom Dimension 5 = Canvas Course Name --- Scope = Hit
// Custom Dimension 6 = Canvas Sub-Account ID --- Scope = Hit
// Custom Dimension 7 = Canvas Term ID --- = Scope = Hit
// Custom Dimension 8 = Canvas Course Role --- Scope = Hit

(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'custom_ga');

function removeStorage(key) {
    try {
        localStorage.removeItem(key);
        localStorage.removeItem(key + '_expiresIn');
    } catch (e) {
        console.log('removeStorage: Error removing key [' + key + '] from localStorage: ' + JSON.stringify(e));
        return false;
    }
    return true;
}

function getStorage(key) {
    var now = Date.now(); //epoch time, lets deal only with integer
    // set expiration for storage
    var expiresIn = localStorage.getItem(key + '_expiresIn');
    if (expiresIn === undefined || expiresIn === null) {
        expiresIn = 0;
    }

    if (expiresIn < now) { // Expired
        removeStorage(key);
        return null;
    } else {
        try {
            var value = localStorage.getItem(key);
            return value;
        } catch (e) {
            console.log('getStorage: Error reading key [' + key + '] from localStorage: ' + JSON.stringify(e));
            return null;
        }
    }
}

function setStorage(key, value, expires) {
    if (expires === undefined || expires === null) {
        expires = (24 * 60 * 60); // default: seconds for 6 hours (6*60*60)
    } else {
        expires = Math.abs(expires); //make sure it's positive
    }

    var now = Date.now(); //millisecs since epoch time, lets deal only with integer
    var schedule = now + expires * 1000;
    try {
        localStorage.setItem(key, value);
        localStorage.setItem(key + '_expiresIn', schedule);
    } catch (e) {
        console.log('setStorage: Error setting key [' + key + '] in localStorage: ' + JSON.stringify(e));
        return false;
    }
    return true;
}

async function coursesRequest(courseId) {
    // 
    let response = await fetch('/api/v1/users/self/courses?per_page=100');
    let data = await response.text();
    data = data.substr(9);
    data = JSON.parse(data)
    var stringData = JSON.stringify(data)
    setStorage('ga_enrollments', stringData, null)
    var course = parseCourses(courseId, stringData)
    return course
};

function parseCourses(courseId, courseData) {
    if (courseData != undefined) {
        let data = JSON.parse(courseData);
        //console.log(data)
        for (var i = 0; i < data.length; i++) {
            // console.log(data[i]['id'] + " " + courseId)
            if (data[i]['id'] == courseId) {
                return data[i]
            }
        }
    }
    return null
}

function gaCourseDimensions(course) {
    custom_ga('set', 'dimension4', course['id']);
    custom_ga('set', 'dimension5', course['name']);
    custom_ga('set', 'dimension6', course['account_id']);
    custom_ga('set', 'dimension7', course['enrollment_term_id']);
    custom_ga('set', 'dimension8', course['enrollments'][0]['type']);
    custom_ga('send', 'pageview');
    return
}

function googleAnalyticsCode(trackingID) {
    var userId, userRoles, attempts, courseId;
    custom_ga('create', trackingID, 'auto');
    userId = ENV["current_user_id"];
    userRoles = ENV['current_user_roles'];
    custom_ga('set', 'userId', userId);
    custom_ga('set', 'dimension1', userId);
    custom_ga('set', 'dimension3', userRoles);
    courseId = window.location.pathname.match(/\/courses\/(\d+)/);
    if (courseId) {
        courseId = courseId[1];
        attempts = 0;
        try {
            let courses = getStorage('ga_enrollments')
            if (courses != null) {
                var course = parseCourses(courseId, courses);
                if (course === null) {
                    // console.log("course_id not found in cache, retrieving...")
                    coursesRequest(courseId).then(course => {
                        if (course === null) {
                            // console.log("course data not found")
                            custom_ga('set', 'dimension4', courseId);
                            custom_ga('send', 'pageview');
                        } else {
                            gaCourseDimensions(course)
                        }
                    });
                } else {
                    // console.log("course found in cache")
                    gaCourseDimensions(course)
                }
            } else {
                // console.log("cache not found, retrieving cache data")
                coursesRequest(courseId).then(course => {
                    if (course === null) {
                        // console.log("course data not found")
                        custom_ga('set', 'dimension4', courseId);
                        custom_ga('send', 'pageview');
                    } else {
                        gaCourseDimensions(course)
                    }
                });
            }
        } catch (err) {
            attempts += 1;
            if (attempts > 5) {
                custom_ga('set', 'dimension4', courseId);
                custom_ga('send', 'pageview');
                return;
            };
        };
    } else {
        custom_ga('send', 'pageview');
    };
};

// Braven Canvas UI tracking ID:
googleAnalyticsCode("UA-192454252-1")

///// END Canvas Google Analytics
