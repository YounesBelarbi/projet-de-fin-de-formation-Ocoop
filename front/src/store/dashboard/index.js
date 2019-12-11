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
    }],
  gameList: [
    {
      gameId: 2,
      name: "CS:Go",
      image: "https://steamcdn-a.akamaihd.net/steam/subs/54029/header_586x192.jpg?t=1544227353",
      background: "csgo-bg",
      isSelected: true
    },
    {
      gameId: 3,
      name: "Adibou",
      image: "https://images-na.ssl-images-amazon.com/images/I/51lek1O4e4L.jpg",
      background: "adibou-bg",
      isSelected: false
    },
    {
      gameId: 1,
      name: "SpongeBob",
      image: "https://upload.wikimedia.org/wikipedia/en/3/33/SpongeBob_SuperSponge_PS1.jpg",
      background: "img",
      isSelected: false
    },
    {
      gameId: 5,
      name: "Overwatch",
      image: "https://blznav.akamaized.net/img/games/cards/card-overwatch-7eff92e1257149aa.jpg",
      background: "img",
      isSelected: false
    }
  ]};

const dashboardReducer = (state = initialState, action) => {
    console.log('reducer[dashboard] >>', action);
    switch(action.type) {
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
        default :
            return state
    }
};

export default dashboardReducer;