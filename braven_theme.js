/* 
 * This Javascript is uploaded to our Braven Theme on Canvas cloud. E.g.
 * https://braven.instructure.com/accounts/1/theme_editor
 */

jQuery(document).ready(function($) {

  // Adds styling to the 'View Feedback' link on an uploaded file submission that has
  // been annotated by the grader. Allows the student to more easily find it.
  function styleFileUploadViewAnnotationsLink() {
    feedback_link = document.querySelector('.file-upload-submission-attachment .modal_preview_link');
    if (feedback_link) {
      feedback_link.classList.remove('Button--link');
      feedback_link.classList.add('Button', 'Button--secondary');
    }
  }

  styleFileUploadViewAnnotationsLink();
  
});
