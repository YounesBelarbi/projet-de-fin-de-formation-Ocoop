import { register as actions } from 'src/store/actions';
import { useSelector, useDispatch } from 'react-redux';

const initialState = {
  showEditor: false,
  user: {
    username: 'Pascalou',
    frequency: 'Compétiteur',
    description: 'Je recherche des joueurs de mon age et de mon niveau'
  },
  copyChange: {}
};

const headerDashboardReducer = (state = initialState, action) => {
    console.log('reducer[headerDashboard] >>', action);
    switch(action.type) {
        case 'SET_USER_INFOS' :
        return {
          ...state,
          user: {
            ...action.data.user,
            frequency: action.data.user_frequency
          },
          frequencyList: action.data.frequency_list
        }
        case 'SHOW_EDIT_PROFILE' :
            if(state.showEditor === false) {
                return {
                    ...state,
                    showEditor: !state.showEditor,
                    copyChange: {
                        username: state.user.username,
                        frequency: state.user.frequency,
                        description: state.user.description
                    }
                }
            }
            else {
                return {
                    ...state,
                    showEditor: !state.showEditor,
                    copyChange: {}
                }
            }
        case 'EDIT_PROFILE_USERNAME' :
            return {
                ...state,
                copyChange: {
                    ...state.copyChange,
                    username: action.data
                }
            }
        case 'EDIT_PROFILE_FREQUENCY' :
            return {
                ...state,
                copyChange: {
                    ...state.copyChange,
                    frequency: action.data
                }
            }
        case 'EDIT_PROFILE_DESCRIPTION' :
            return {
                ...state,
                copyChange: {
                    ...state.copyChange,
                    description: action.data
                }
            }
        case 'SUBMIT_EDIT_PROFILE' :
            return {
                ...state,
                showEditor: false,
                user: {
                    ...state.user,
                    username: state.copyChange.username,
                    frequency: state.copyChange.frequency,
                    description: state.copyChange.description
                },
                copyChange: { }
            }
        case 'LOGOUT' :
            return {
                ...initialState
            }
        default :
            return state
    }
};

export default headerDashboardReducer;