import { register as actions } from 'src/store/actions';
import { useSelector, useDispatch } from 'react-redux';

const initialState = {
  showEditor: false,
  username: 'Pascal',
  frequency: 'Compétiteur',
  description: 'Tu casses les couilles comme la RATP, et j\'t\'en*ule comme l\'heure du RDV',
  copyChange: {}
};

const headerDashboardReducer = (state = initialState, action) => {
    console.log('reducer[headerDashboard] >>', action);
    switch(action.type) {
        case 'SHOW_EDIT_PROFILE' :
            if(state.showEditor === false) {
                return {
                    ...state,
                    showEditor: !state.showEditor,
                    copyChange: {
                        username: state.username,
                        frequency: state.frequency,
                        description: state.description
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
                username: state.copyChange.username,
                frequency: state.copyChange.frequency,
                description: state.copyChange.description,
                copyChange: { }
            }
        default :
            return state
    }
};

export default headerDashboardReducer;