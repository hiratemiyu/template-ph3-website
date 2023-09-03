'use strict';

{
  const Header = document.getElementById('js-header');
  const HeaderButton = document.getElementById('js-headerButton');
  if (HeaderButton) {
    HeaderButton.addEventListener('click', () => {
      Header.classList.toggle('is-open')
    })
  }





document.addEventListener('DOMContentLoaded', () => {

// // モーダルにidを渡す
// const deleteButtons = document.querySelectorAll('[data-modal-target="popup-modal"]');
// const confirmDeleteButton = document.getElementById('confirm-delete-button');
// const modal = document.getElementById('popup-modal');

// deleteButtons.forEach(button => {
//   button.addEventListener('click', () => {
//     const quizId = button.getAttribute('data-quiz-id');
//     confirmDeleteButton.setAttribute('data-quiz-id', quizId);
//     modal.classList.remove('hidden');
//   });
// });

  // モーダルの開閉
  const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
  const modalHideButtons = document.querySelectorAll('[data-modal-hide]');


  modalToggleButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      const targetModalId = event.currentTarget.getAttribute('data-modal-target');
      const targetModal = document.getElementById(targetModalId);

      if (targetModal) {
        targetModal.classList.toggle('hidden');
      }
    });
  });

  modalHideButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      const targetModalId = event.currentTarget.closest('.fixed').id;
      const targetModal = document.getElementById(targetModalId);

      if (targetModal) {
        targetModal.classList.add('hidden');
      }
    });
  });
});

}
