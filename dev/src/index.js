import sass from './scss/styles.scss';
import Brain from './js/components/Brain';

if (document.querySelector('.home')) {
  const brain = new Brain(document.querySelectorAll('.tag'));
  brain.loop();

  let modal = document.getElementById('info');

  document.onmouseup = e => {
    if (modal.classList.contains('active')) {
      if (e.target !== modal) {
        modal.classList.remove('active');
      }
    }
  };
}
