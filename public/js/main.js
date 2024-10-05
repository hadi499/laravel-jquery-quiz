document.addEventListener('DOMContentLoaded', function () {
  console.log('main/easy');

  const modalBtns = [...document.getElementsByClassName('modal-button')];
  const modalTitle = document.getElementById('modal-title-confirm');
  const modalBody = document.getElementById('modal-body-confirm');
  const startButton = document.getElementById('start-button');

  const url = window.location.href;
  console.log(url);

  modalBtns.forEach(modalBtn => {
    modalBtn.addEventListener('click', () => {
      // Capture data attributes
      const id = modalBtn.getAttribute('data-id');
      const name = modalBtn.getAttribute('data-quiz');
      const numQuestions = modalBtn.getAttribute('data-questions');
      const scoreToPass = modalBtn.getAttribute('data-pass');
      const time = modalBtn.getAttribute('data-time');

      // Log the captured data to ensure it's being retrieved
      console.log('Quiz Data:', {
        id,
        name,
        numQuestions,
        scoreToPass,
        time
      });

      // Check if data is correctly captured
      if (name && numQuestions && scoreToPass && time) {
        // Update the modal title
        modalTitle.innerHTML = `${name}`;

        // Update the modal body content
        modalBody.innerHTML = `
          <div>
            <ul>
              <li>Number of questions: <b>${numQuestions}</b></li>
              <li>Score to pass: <b>${scoreToPass}</b></li>
              <li>Time: <b>${time}</b></li>
            </ul>
          </div>
        `;
      } else {
        console.log('Failed to retrieve quiz data.');
      }

      // Start button event listener to navigate
      startButton.addEventListener('click', () => {
        window.location.href = url + '/' + id;
      });
    });
  });
});
