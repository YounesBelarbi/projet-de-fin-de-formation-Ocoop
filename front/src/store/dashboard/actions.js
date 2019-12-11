export const actions = {
    SHOW_PLAYER_CARD: 'dashboard/action/SHOW_PLAYER_CARD',
    SELECT_GAME: 'dashboard/action/SELECT_GAME'
  };
  
export const showPlayerCard = () => ({
    type: actions.SHOW_PLAYER_CARD
});

export const selectGame = () => ({
  type: actions.SELECT_GAME
});
  