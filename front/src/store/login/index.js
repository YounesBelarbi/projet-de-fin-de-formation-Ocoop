import { register as actions } from 'src/store/actions';
import { useSelector, useDispatch } from 'react-redux';

const initialState = {
  
  email: '',
  password: '',
};

const loginReducer = (state = initialState, action) => {
    console.log('reducer[login] >>', action);
    switch(action.type) {
        case 'LOGIN_EMAIL' :
            return {
                ...state,
                email: action.data
            }
        case 'LOGIN_PASSWORD' :
            return {
                ...state,
                password: action.data
            }
        case 'SET_EMAIL_VALUE' :
            return {
                ...state,
                email: action.data
            }
        case 'SET_USER_INFOS' :
            return {
                ...state,
                email: "",
                password: ""
            }
        default :
            return state
    }
};

export default loginReducer;