const loginForm = document.querySelector('#login-form');
loginForm.addEventListener('submit', (e) => {
     e.preventDefault();
     const email = loginForm['login-email'].value;
     const password = loginForm['login-password'].value;

     auth.signInWithEmailAndPassword(email, password).then(cred => {
          window.open('dashboard.php');
          loginForm.reset();
          loginForm.querySelector('.error').innerHTML = '';
     }).catch(ERR => {
          loginForm.querySelector('.error').innerHTML = ERR.message;
      })
})

const signupForm = document.querySelector('#signup-form');
signupForm.addEventListener('submit', (e) => {
     e.preventDefault();

     //get User info
    const email = signupForm['signup-email'].value;
    const password = signupForm['signup-password'].value;

    //signup the user
    console.log(email);
    auth.createUserWithEmailAndPassword(email, password).then(cred => {
     const modal = document.querySelector('#modal-signup');
     M.Modal.getInstance(modal).close();
     signupForm.reset();
     signupForm.querySelector('.error').innerHTML = '';
 }).catch(err => {
     signupForm.querySelector('.error').innerHTML = err.message;
 });
})