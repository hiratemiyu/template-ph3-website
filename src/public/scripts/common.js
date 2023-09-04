'use strict';

{
  const Header = document.getElementById('js-header');
  const HeaderButton = document.getElementById('js-headerButton');
  if (HeaderButton) {
    HeaderButton.addEventListener('click', () => {
      Header.classList.toggle('is-open')
    })
  }

  // モーダル
  document.addEventListener('DOMContentLoaded', () => {    
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