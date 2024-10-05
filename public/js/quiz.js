document.addEventListener('DOMContentLoaded', function () {
  console.log('quiz');

  const quizBox = document.getElementById('quiz-box');
  const scoreBox = document.getElementById('score-box');
  const resultBox = document.getElementById('result-box');
  const timerBox = document.getElementById('timer-box');
  const wrapTimer = document.getElementById('wrap-timer');
  const startLagi = document.getElementById('start-lagi');
  const url = window.location.href;
  const quizForm = document.getElementById('quiz-form');

  console.log(url);

  // Aktivasi Timer
  const activateTimer = (timeInSeconds) => {
    let seconds = timeInSeconds;

    const updateDisplay = () => {
      let displaySeconds = seconds < 10 ? '0' + seconds : seconds;
      timerBox.innerHTML = `<b class="text-primary">${displaySeconds}</b>`;
    };

    // Tampilkan detik awal
    updateDisplay();

    const timer = setInterval(() => {
      seconds--;

      if (seconds < 0) {
        clearInterval(timer);
        wrapTimer.classList.add('border-danger');
        timerBox.innerHTML = `<b class="text-danger rounded">00</b>`;
        sendData(); // Kirim data saat waktu habis
      } else {
        updateDisplay();
      }
    }, 1000);

    // Menghentikan timer saat form di-submit
    quizForm.addEventListener('submit', () => {
      clearInterval(timer);
      console.log('Timer dihentikan karena submit');
    });
  };

  // Ambil pertanyaan dan jawaban
  $.ajax({
    type: 'GET',
    url: `${url}/data`,
    success: function (response) {
      // console.log(response);
      const data = response.data;

      data.forEach(el => {
        for (const [question, answers] of Object.entries(el)) {
          let questionDiv = `
            <div class="mb-3 border " style="width: 150px;">
              <div class="text-center mb-2 bg-primary-subtle py-2">
                <b>${question}</b>
              </div>
              <div>
          `;

          answers.forEach(answer => {
            questionDiv += `
              <div class="px-3 mb-2">
                <input type="radio" class="ans form-check-input" id="${question}-${answer}" name="${question}" value="${answer}">
                <label for="${question}-${answer}">${answer}</label>
              </div>
            `;
          });

          questionDiv += '</div></div>';
          quizBox.innerHTML += questionDiv;
        }
      });

      activateTimer(response.time);
    },
    error: function (error) {
      console.log(error);
    }
  });

  // Kirim data jawaban ke server
  const sendData = () => {
    const elements = [...document.getElementsByClassName('ans')];
    const data = {
      '_token': $('meta[name="csrf-token"]').attr('content') // Ambil token CSRF dari meta tag
    };

    elements.forEach(el => {
      if (el.checked) {
        data[el.name] = el.value;
        console.log(`Jawaban dipilih: ${el.value} untuk ${el.name}`);
      } else {
        if (!data[el.name]) {
          data[el.name] = null;
        }
      }
    });

    $.ajax({
      type: 'POST',
      url: `${url}/save`,
      data: data,

      success: function (response) {
        console.log(data)
        console.log(response);
        console.log(url)
        quizForm.classList.add('not-visible');


        const lulus = `<div class="text-primary">😁 Lulus, score: ${response.score}</div>`;
        const gagal = `<div class="text-danger">🥵 Gagal, score: ${response.score}</div>`;
        scoreBox.innerHTML = response.passed ? lulus : gagal;
        startLagi.innerHTML = `<a href="${url}" class="btn btn-outline-primary">Start game lagi</a>`;

        response.results.forEach(res => {
          const resDiv = document.createElement('div');
          for (const [question, resp] of Object.entries(res)) {
            // console.log('res', res)
            // console.log('test', question.title)
            let questionObj = JSON.parse(question);

            // Sekarang bisa mengakses title dari objek question
            console.log('Title:', questionObj.title);
            resDiv.innerHTML += questionObj.title;
            const cls = ['container', 'p-3', 'text-light', 'h6', 'mt-4'];
            resDiv.classList.add(...cls);
            resDiv.style.width = '300px';

            if (resp === 'not answered') {
              resDiv.innerHTML += ', Tidak dijawab';
              resDiv.classList.add('bg-danger');
            } else {
              const answer = resp['answered'];
              const correct = resp['correct_answer'];

              if (answer === correct) {
                resDiv.classList.add('bg-success');
                resDiv.innerHTML += ` | dijawab: ${answer}`;
              } else {
                resDiv.classList.add('bg-danger');
                resDiv.innerHTML += ` | dijawab: ${answer}`;
              }
            }
          }
          resultBox.append(resDiv);

        });
      },
      error: function (error) {
        console.log(error);
      }
    });




  };

  // Tambahkan event listener untuk submit form
  quizForm.addEventListener('submit', function (e) {
    e.preventDefault();
    sendData();
  });
});
