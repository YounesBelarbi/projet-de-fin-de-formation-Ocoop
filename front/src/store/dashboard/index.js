import { register as actions } from 'src/store/actions';
import { useSelector, useDispatch } from 'react-redux';

const initialState = {
  favoriteGameList : [],
  matchingResultPlayers: [],
  addGamePanel: {
    gameList: [],
    rankList: [],
    isOpen: false,
    gameToAdd: {
      plateformId: '',
      gameId: '',
      rankId: '',
      frequencyId: '',
    }
  }
};

const dashboardReducer = (state = initialState, action) => {
    console.log('reducer[dashboard] >>', action);
    switch(action.type) {
      case 'SET_USER_INFOS' :
        if(action.data.favorite_games.length > 0) {
          action.data.favorite_games[0] = {
            ...action.data.favorite_games[0],
            isSelected: true
          }
              return {
                ...state,
                favoriteGameList: [
                  ...action.data.favorite_games
                ],
                token: action.data.token
              }
        }
        else {
          return {
            ...state,
            token: action.data.token,
            favoriteGameList : [],
            addGamePanel: {
              ...state.addGamePanel,
              isOpen: true,
              gameToAdd: {
                plateformId: '',
                gameId: '',
                rankId: '',
                frequencyId: '',
              }
            }
          }
        }
        case 'SHOW_PLAYER_CARD' :
          //TODO BIEN INVERSER AU BON ENDROIT
          let object = {...state.matchingResultPlayers[0][action.data], isOpen: !state.matchingResultPlayers[0][action.data].isOpen};
          let array = [...state.matchingResultPlayers[0]];
          array[action.data] = object;
          return {
            ...state,
            matchingResultPlayers: [array]
          }
        case 'SELECT_GAME' :
          let newGameList = state.favoriteGameList.map((game, key) => {
            return {
              ...game, isSelected: false
            }
          });
          let newObject = {...newGameList[action.data], isSelected: true};
          newGameList[action.data] = newObject;
          return {
            ...state,
            favoriteGameList: newGameList,
            addGamePanel: {
              ...state.addGamePanel,
              isOpen: false
            }
          }
        case 'GET_GAME_LIST' :
          return {
            ...state,
            addGamePanel: {
              ...state.addGamePanel,
              gameList: action.data
            }
          }
        case 'GET_RANKS_BY_GAME' :
          return {
            ...state,
            addGamePanel: {
              ...state.addGamePanel,
              rankList: action.data
            }
          }
        case 'SHOW_ADD_GAME_PANEL' : 
        let newGameListSelectedOnFalse
        if(!state.addGamePanel.isOpen) {
          newGameListSelectedOnFalse = state.favoriteGameList.map((game) => {
            return {
              ...game, isSelected: false
            }
          });
          return {
            ...state,
            favoriteGameList: newGameListSelectedOnFalse,
            addGamePanel: {
              ...state.addGamePanel,
              isOpen: !state.addGamePanel.isOpen
            }
          }
        }
        else {
          if(state.favoriteGameList.length > 0){
            newGameListSelectedOnFalse = state.favoriteGameList.map((game, key) => {
              return {
                ...game, isSelected: false
              }
            });
            let newObjectDefaultSelected = {...newGameListSelectedOnFalse[0], isSelected: true};
            newGameListSelectedOnFalse[0] = newObjectDefaultSelected;
            return {
              ...state,
              favoriteGameList: newGameListSelectedOnFalse,
              addGamePanel: {
                ...state.addGamePanel,
                isOpen: !state.addGamePanel.isOpen
              }
            }
          }
          else {
            return {
              ...state
            }
          }
          }
          case 'ADD_FAVORITE_SELECTED_PLATFORM' : 
            return {
              ...state,
              addGamePanel: {
                ...state.addGamePanel,
                gameToAdd: {
                  ...state.addGamePanel.gameToAdd,
                  plateformId: action.data,
                  gameId: "",
                  rankId: "",
                  frequencyId: ""
                }
              }
            }
          case 'ADD_FAVORITE_SELECTED_GAME' : 
          return {
            ...state,
            addGamePanel: {
              ...state.addGamePanel,
              gameToAdd: {
                ...state.addGamePanel.gameToAdd,
                gameId: action.data,
                rankId: "",
                frequencyId: ""
              }
            }
          }
          case 'ADD_FAVORITE_SELECTED_RANK' : 
          return {
            ...state,
            addGamePanel: {
              ...state.addGamePanel,
              gameToAdd: {
                ...state.addGamePanel.gameToAdd,
                rankId: action.data,
                frequencyId: ""
              }
            }
          }
          case 'ADD_FAVORITE_SELECTED_FREQUENCY' : 
          return {
            ...state,
            addGamePanel: {
              ...state.addGamePanel,
              gameToAdd: {
                ...state.addGamePanel.gameToAdd,
                frequencyId: action.data
              }
            }
          }
          case 'ADD_FAVORITE_GAME' :
            return {
              ...state,
              favoriteGameList: [
                ...state.favoriteGameList,
                {
                  ...action.data
                }
              ],
              addGamePanel: {
                ...state.addGamePanel,
                gameToAdd: {
                  plateformId: '',
                  gameId: '',
                  rankId: '',
                  frequencyId: ''
                }
              }
            }
            case 'SET_INFOS_TO_FIND_MATE' :
              let infosToFindMates
              state.favoriteGameList.forEach((game) => {
                if(game.isSelected){
                  infosToFindMates = {
                    game_id: game.game_id,
                    rank_id: game.rank_id
                  }
                }
              });
              return {
                ...state,
                findMates: infosToFindMates
              }
            case 'SHOW_MATE' : 
              console.log("show_mate",action.data);
              
              // array = [];
              // array[action.data[0].game_name] = [...action.data];
              //let arrayId = Object.values(action.data)[0].game_id;
              // let newResultArray = [];
              // newResultArray[arrayName] = action.data;
              //console.log(arrayId);
              return {
                ...state,
                matchingResultPlayers: 
                //...state.matchingResultPlayers,
                Object.values(action.data)
              
              }
            case 'DELETE_GAME' :
              //const gameIdToRemove = action.data;
              const coucou = [...state.favoriteGameList];

              const newFavoriteGameArray = coucou.filter((item) => item.game_id !== action.data);
              console.log(newFavoriteGameArray);  
              return {
                  ...state,
                  favoriteGameList: newFavoriteGameArray
                }
            case 'LOGOUT' :
              return {
                  ...initialState
              }
        default :
            return state
    }
};

export default dashboardReducer;