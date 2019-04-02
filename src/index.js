import sass from './scss/styles.scss';
import Brain from './js/components/Brain';

if (document.querySelector('.tagsWrapper')) {
  const brain = new Brain(document.querySelectorAll('.tag'));
  brain.loop();

  const modal = document.getElementById('info');

  document.onmouseup = e => {
    if (modal.classList.contains('active')) {
      if (e.target !== modal) {
        modal.classList.remove('active');
      }
    }
  };
}

const participants = document.querySelectorAll('.participantsMenu li');

for (let i = 0; i < participants.length; i++) {
  const ele = participants[i];
  ele.onclick = e => {};
  console.log();
}
