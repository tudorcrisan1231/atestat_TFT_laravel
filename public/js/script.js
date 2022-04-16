function show_bookmark() {
  const bookmark_btn = document.querySelector('.home_bookmarks_btn');
  const bookmark_dropdown = document.querySelector('.home_bookmarks_dropdown');
  if (bookmark_btn && bookmark_dropdown) {
    bookmark_btn.addEventListener('click', function () {
      bookmark_dropdown.classList.toggle('hidden_bookmark');
      bookmark_btn.classList.toggle('btn_open');
    });
  }
}
show_bookmark();

function close_bookmarkAlert() {
  if (document.querySelector('.alert_bookmark_close')) {
    document.querySelector('.alert_bookmark_close').addEventListener('click', function () {
      document.querySelector('.alert_bookmark').style.display = 'none';
    });
  }
}
close_bookmarkAlert();


const labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
];

const data = {
  labels: labels,
  datasets: [{
    label: 'My First dataset',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [0, 10, 5, 2, 20, 30, 45],
  }]
};

const config = {
  type: 'line',
  data: data,
  options: {}
};
const myChart = new Chart(
  document.getElementById('myChart'),
  config
);


