export const actions = {
    CHANGE_USERNAME: 'register/action/CHANGE_USERNAME',
    CHANGE_EMAIL: 'register/action/CHANGE_EMAIL',
    CHANGE_BIRTHDATE: 'register/action/CHANGE_BIRTHDATE',
    CHANGE_PASSWORD: 'register/action/CHANGE_PASSWORD',
    CHANGE_VERIFPASSWORD: 'register/action/CHANGE_VERIFPASSWORD',
    SUBMIT_SIGNUP: 'register/action/SUBMIT_SIGNUP' //action de submit register
  };
  
export const register = (registerType) => ({
  // eval permet d'exécuter du code écrit dans une chaîne de caractère.
  // cf. https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Objets_globaux/eval
  // C'est un outil puissant mais dangereux ! Ici, c'est acceptable car le
  // reducer va sécuriser le traitement des actions.
  type: eval(`actions.CHANGE_${registerType.toUpperCase()}`)
});

export const submitSignup = () => ({
  type: actions.SUBMIT_SIGNUP
});
  