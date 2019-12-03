import { register as actions } from 'src/store/actions';

const initialState = {
  email: '',
  password: '',
};

const registerReducer = (state = initialState, action) => {
    console.log('reducer[register] >>', action);
    switch(action.type) {
        case 'LOGIN_EMAIL' :
            return {
                ...state,
                email: action.data
            }
        case 'LOGIN_PASSWORD' :
            return {
                ...state,
                username: action.data
            }
        default :
            return state
    }
};

export default registerReducer;