import { combineReducers } from 'redux';

import registerReducer from 'src/store/register';
import loginReducer from 'src/store/login';

export default combineReducers({
  registerReducer,
  loginReducer
});
