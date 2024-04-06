const loginButton = document.getElementById('login-button');
const registerButton = document.getElementById('register-button');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

registerButton.addEventListener('click', () => {
  loginForm.style.display = 'none';
  registerForm.style.display = 'block';
  registerButton.classList.add('active');
  loginButton.classList.remove('active');
});

loginButton.addEventListener('click', () => {
  loginForm.style.display = 'block';
  registerForm.style.display = 'none';
  loginButton.classList.add('active');
  registerButton.classList.remove('active');
});

registerForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Ngăn chặn trang web được tải lại sau khi submit form
  const username = document.getElementById('register-username').value;
  const password = document.getElementById('register-password').value;

  // Lưu thông tin tài khoản đăng ký vào localStorage
  localStorage.setItem('username', username);
  localStorage.setItem('password', password);

  // Thông báo đăng ký thành công và chuyển hướng đến trang đăng nhập
  alert('Đăng ký thành công!, Bạn hãy đăng nhập !!!');
  window.location.href = 'index.html'; // Chuyển hướng đến trang đăng nhập
});


//modal for mobile
const loginButton_ = document.getElementById('login-button_');
const registerButton_ = document.getElementById('register-button_');
const loginForm_ = document.getElementById('login-form_');
const registerForm_ = document.getElementById('register-form_');

registerButton_.addEventListener('click', () => {
  loginForm_.style.display = 'none';
  registerForm_.style.display = 'block';
  registerButton_.classList.add('active');
  loginButton_.classList.remove('active');
});

loginButton_.addEventListener('click', () => {
  loginForm_.style.display = 'block';
  registerForm_.style.display = 'none';
  loginButton_.classList.add('active');
  registerButton_.classList.remove('active');
});

registerForm_.addEventListener('submit', (event) => {
  event.preventDefault(); // Ngăn chặn trang web được tải lại sau khi submit form
  const username_ = document.getElementById('register-username_').value;
  const password_ = document.getElementById('register-password_').value;

  // Lưu thông tin tài khoản đăng ký vào localStorage
  localStorage.setItem('username_', username_);
  localStorage.setItem('password_', password_);

  // Thông báo đăng ký thành công và chuyển hướng đến trang đăng nhập
  alert('Đăng ký thành công!, Bạn hãy đăng nhập !!!');
  window.location.href = 'index.html'; // Chuyển hướng đến trang đăng nhập
});

loginForm_.addEventListener('submit', (event) => {
  event.preventDefault(); // Ngăn chặn trang web được tải lại sau khi submit form
  const username_= document.getElementById('login-username_').value;
  const password_ = document.getElementById('login-password_').value;
  localStorage.setItem('current_login', username_);

  // Kiểm tra thông tin đăng nhập
  const savedUsername = localStorage.getItem('username');
  const savedPassword = localStorage.getItem('password');
  
  const savedUsername_ = localStorage.getItem('username_');
  const savedPassword_ = localStorage.getItem('password_');
  
  if ((username_ === savedUsername && password_ === savedPassword) ||(username_ === savedUsername_ && password_ === savedPassword_) ) {
    // Thực hiện hành động nếu thông tin đăng nhập giống nhau\
    window.location.href = 'uindex.html'; // Chuyển hướng đến trang chính

  } else {
    alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại!');
  }
});

///login

loginForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Ngăn chặn trang web được tải lại sau khi submit form
  const username = document.getElementById('login-username').value;
  const password = document.getElementById('login-password').value;
  localStorage.setItem('current_login', username);

  const savedUsername = localStorage.getItem('username');
  const savedPassword = localStorage.getItem('password');
  
  const savedUsername_ = localStorage.getItem('username_');
  const savedPassword_ = localStorage.getItem('password_');
  
  if ((username === savedUsername && password === savedPassword) ||(username === savedUsername_ && password === savedPassword_) ) {
    // Thực hiện hành động nếu thông tin đăng nhập giống nhau
    window.location.href = 'uindex.html'; // Chuyển hướng đến trang chính

  } else {
    alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại!');
  }
});
// end modal for mobile

// // nạp tiền
const atm = document.getElementById('atm');
const vi_dien_tu = document.getElementById('vi_dien_tu');
const atm_text = document.getElementById('atm_text');
const vi_dien_tu_text = document.getElementById('vi_dien_tu_text');

vi_dien_tu.addEventListener('click', () => {
  atm_text.style.display = 'none';
  vi_dien_tu_text.style.display = 'block';
  vi_dien_tu.classList.add('active');
  atm.classList.remove('active');
});

atm.addEventListener('click', () => {
  atm_text.style.display = 'block';
  vi_dien_tu_text.style.display = 'none';
  atm.classList.add('active');
  vi_dien_tu.classList.remove('active');
});

vi_dien_tu_text.addEventListener('submit', (event) => {
  event.preventDefault(); // Ngăn chặn trang web được tải lại sau khi submit form
  const username = document.getElementById('register-username').value;
  const password = document.getElementById('register-password').value;

  // Lưu thông tin tài khoản đăng ký vào localStorage
  localStorage.setItem('username', username);
  localStorage.setItem('password', password);

  // Thông báo đăng ký thành công và chuyển hướng đến trang đăng nhập
  alert('Đăng ký thành công!');
  window.location.href = 'login.html'; // Chuyển hướng đến trang đăng nhập
});

atm_text.addEventListener('submit', (event) => {
  event.preventDefault(); // Ngăn chặn trang web được tải lại sau khi submit form
  const username = document.getElementById('login-username').value;
  const password = document.getElementById('login-password').value;

  // Kiểm tra thông tin đăng nhập
  const savedUsername = localStorage.getItem('username');
  const savedPassword = localStorage.getItem('password');

  if (username === savedUsername && password === savedPassword) {
    // alert('Đăng nhập thành công!');
    window.location.href = 'home.html'; // Chuyển hướng đến trang chính
  } else {
    alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại!');
  }
});
//
// When the user scrolls down 80px from the top of the document, add "sticky" class to header
window.onscroll = function() {myFunction()};

var header = document.querySelector("header");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}