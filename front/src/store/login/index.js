import { register as actions } from 'src/store/actions';

const initialState = {
  email: '',
  password: '',
};

const loginReducer = (state = initialState, action) => {
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
                password: action.data
            }
        default :
            return state
    }
};

export default loginReducer;