import { register as actions } from 'src/store/actions';
import { useSelector, useDispatch } from 'react-redux';

const initialState = {
  favoriteGameList : [],
  matchingResultPlayers: [
    {
      userId: 32,
      username: "TheKairi78",
      image: "http://image.noelshack.com/fichiers/2017/22/1496181267-kenny-vomir1.png",
      description: "Je carry les noobs sur Adibou ajoutez moi. Mon steam: TK78",
      isOpen: false
    },
    {
      userId: 12,
      username: "ChristCosmique28",
      image: "https://www.nouvelordremondial.cc/wp-content/uploads/2018/07/durif-pas-mort.jpg",
      description: "",
      isOpen: false
    },
    {
      userId: 23,
      username: "lampereur",
      image: "https://www.numero.com/sites/default/files/images/article_new/slides/alkpotecfifou-0073alkpote-album-monument-rap-francais-numero-magazine.jpg",
      description: "Je carry",
      isOpen: false
    },
    {
      userId: 46,
      username: "Clovis",
      image: "https://i.skyrock.net/6138/53906138/pics/2789465568_small_1.jpg",
      description: "ajoutez moi",
      isOpen: false
    }
  ],
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
          let object = {...state.matchingResultPlayers[action.data], isOpen: !state.matchingResultPlayers[action.data].isOpen};
          let array = [...state.matchingResultPlayers];
          array[action.data] = object;
          return {
            ...state,
            matchingResultPlayers: array
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
            console.log("showmate data",action.data);
              return {
                ...state,
                matchingResultPlayers: {...action.data}
              }
            case 'LOGOUT' :
              return {
                  
              }
        default :
            return state
    }
};

export default dashboardReducer;