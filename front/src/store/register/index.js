import { register as actions } from 'src/store/actions';

const initialState = {
  username: '',
  email: '',
  birth: '',
  password: '',
  password_confirm: ''
};

const registerReducer = (state = initialState, action) => {
    console.log('reducer[register] >>', action);
    switch(action.type) {
        case 'CHANGE_EMAIL' :
            return {
                ...state,
                email: action.data
            }
        case 'CHANGE_USERNAME' :
            return {
                ...state,
                username: action.data
            }
        case 'CHANGE_BIRTHDATE' :
            return {
                ...state,
                birthdate: action.data
            }
        case 'CHANGE_PASSWORD' :
            return {
                ...state,
                password: action.data
            }
        case 'CHANGE_VERIFPASSWORD' :
            return {
                ...state,
                verifPassword: action.data
            }
        default :
            return state
    }
};

export default registerReducer;