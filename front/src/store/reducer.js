import { combineReducers } from 'redux';

import registerReducer from 'src/store/register';
import loginReducer from 'src/store/login';
import dashboardReducer from 'src/store/dashboard';

export default combineReducers({
  registerReducer,
  loginReducer,
  dashboardReducer
});
