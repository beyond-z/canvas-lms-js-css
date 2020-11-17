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
