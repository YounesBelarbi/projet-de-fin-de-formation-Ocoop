export const actions = {
    SHOW_EDIT_PROFILE: 'headerDashboard/action/SHOW_EDIT_PROFILE',
    EDIT_PROFILE_USERNAME: 'headerDashboard/action/EDIT_PROFILE_USERNAME',
    EDIT_PROFILE_FREQUENCY: 'headerDashboard/action/EDIT_PROFILE_FREQUENCY',
    EDIT_PROFILE_DESCRIPTION: 'headerDashboard/action/EDIT_PROFILE_DESCRIPTION',
    SUBMIT_EDIT_PROFILE: 'headerDashboard/action/SUBMIT_EDIT_PROFILE',
  };
  
export const showEditProfile = () => ({
    type: actions.SHOW_EDIT_PROFILE
});

export const editProfile = (editProfileType) => ({
// eval permet d'exécuter du code écrit dans une chaîne de caractère.
// cf. https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Objets_globaux/eval
// C'est un outil puissant mais dangereux ! Ici, c'est acceptable car le
// reducer va sécuriser le traitement des actions.
    type: eval(`actions.EDIT_PROFILE_${editProfileType.toUpperCase()}`)
});

export const submitEditProfile = () => ({
    type: actions.SUBMIT_EDIT_PROFILE
});