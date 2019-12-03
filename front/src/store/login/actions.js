export const actions = {
    LOGIN_EMAIL: 'register/action/LOGIN_USERNAME',
    LOGIN_PASSWORD: 'register/action/LOGIN_PASSWORD',
  };
  
  export const register = (registerType) => ({
    // eval permet d'exécuter du code écrit dans une chaîne de caractère.
    // cf. https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Objets_globaux/eval
    // C'est un outil puissant mais dangereux ! Ici, c'est acceptable car le
    // reducer va sécuriser le traitement des actions.
    type: eval(`actions.LOGIN_${registerType.toUpperCase()}`)
  });
  