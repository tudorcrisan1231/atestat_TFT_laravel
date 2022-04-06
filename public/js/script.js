function popup_login_register(){
    const popup_login = document.querySelector('.popup_login');
      //const popup_register = document.querySelector('.popup_register');
    const layer = document.querySelector('.layer');
    const btn_login = document.querySelector('.login_btn');
    const btn_login_close = document.querySelector('.popup_LOGIN_close');

    const popup_register = document.querySelector('.popup_register');
    const btn_register = document.querySelector('.register_btn');
    const btn_register_close = document.querySelector('.popup_REGISTER_close');

    const btn_login_in = document.querySelector('.login_btn_in');
    
   // if(popup_login && layer && btn_login && btn_login_close && popup_login_register && btn_register && btn_register_close && btn_login_in){
    
      btn_login.addEventListener('click', function(){
          popup_login.classList.toggle('hidden_popup');
          layer.classList.toggle('hidden_popup');
      });
      btn_login_close.addEventListener('click', function(){
          popup_login.classList.toggle('hidden_popup');
          layer.classList.toggle('hidden_popup');
      });
  
      btn_register.addEventListener('click',function(){
          popup_login.classList.toggle('hidden_popup');
          popup_register.classList.toggle('hidden_popup');
      });
  
      btn_register_close.addEventListener('click', function(){
          popup_login.classList.add('hidden_popup');
          popup_register.classList.add('hidden_popup');
          layer.classList.toggle('hidden_popup');
      });
  
      btn_login_in.addEventListener('click', function(){
          popup_login.classList.remove('hidden_popup');
          popup_register.classList.add('hidden_popup');
  
      });
   // }
      console.log('salut');
}
popup_login_register();
  //   tippy('button', {
//     content: 'Global content',
//     // trigger: 'click',
//   });

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