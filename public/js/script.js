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
      
      if(popup_login && layer && btn_login && btn_login_close && popup_login_register && btn_register && btn_register_close && btn_login_in){
     
        btn_login.addEventListener('click', function(){
            popup_login.classList.toggle('hidden');
            layer.classList.toggle('hidden');
        });
        btn_login_close.addEventListener('click', function(){
            popup_login.classList.toggle('hidden');
            layer.classList.toggle('hidden');
        });
    
        btn_register.addEventListener('click',function(){
            popup_login.classList.toggle('hidden');
            popup_register.classList.toggle('hidden');
        });
    
        btn_register_close.addEventListener('click', function(){
            popup_login.classList.add('hidden');
            popup_register.classList.add('hidden');
            layer.classList.toggle('hidden');
        });
    
        btn_login_in.addEventListener('click', function(){
            popup_login.classList.remove('hidden');
            popup_register.classList.add('hidden');
    
        });
      }
      
  }
//   tippy('button', {
//     content: 'Global content',
//     // trigger: 'click',
//   });

  popup_login_register();