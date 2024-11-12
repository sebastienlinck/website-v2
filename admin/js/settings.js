document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modal');
  const btnOpen = document.getElementById('btnOpen');
  const overlay = document.getElementById('overlay');

  btnOpen.addEventListener('click', () => {
      modal.classList.toggle('expanded');
      overlay.style.display = 'flex';
  });

  overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
          modal.classList.remove('expanded');
          overlay.style.display = 'none';
      }
  });
});
