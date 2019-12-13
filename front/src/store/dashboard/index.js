import { register as actions } from 'src/store/actions';
import { useSelector, useDispatch } from 'react-redux';

const initialState = {
  matchingResultPlayers: [
    {
      userId: 32,
      username: "TheKairi78",
      image: "http://image.noelshack.com/fichiers/2017/22/1496181267-kenny-vomir1.png",
      description: "Je carry les noobs sur Adibou ajoutez moi",
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
        return {
          ...state,
          user: {
            ...action.data.user
          },
          favoriteGameList: [
            ...action.data.favorite_games
          ],
          token: action.data.token
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
          let newGameList = state.gameList.map((user, key) => {
            return {
              ...user, isSelected: false
            }
          });
          let newObject = {...newGameList[action.data], isSelected: true};
          newGameList[action.data] = newObject;
          return {
            ...state,
            gameList: newGameList
          }
        case 'SHOW_ADD_GAME_PANEL' : 
          //console.log('ADD_GAME Reducer >>', action.data);   
          return {
            ...state,
            addGamePanel: {
              ...state.addGamePanel,
              isOpen: !state.addGamePanel.isOpen
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
        default :
            return state
    }
};

export default dashboardReducer;