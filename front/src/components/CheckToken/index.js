import React, { useEffect } from 'react';
import { useHistory  } from 'react-router-dom'
import axios from 'axios';


const CheckToken = () => {

    useEffect(() => {
            var history = useHistory();
            token = document.cookie
            //TOUT CE Q4ON VEUT
            if(!token || token === "") {
              history.push("/");
            }
            else(token) => {
              axios.post("http://localhost:8000/api/user/tokencheck",
              "", {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '+token
                }
              }).then(function (response) {
                console.log('HTTP RESPONSE STATUT:', response.status);
                console.log(response);
                if(response.status === 200) {
                  dispatch({
                    type: `SET_USER_INFOS`,
                    data: response.data
                  })
                  history.push("/dashboard");
                }
                else {
                    console.log('error serveur');
                }
              }).catch(function (error) {
          
                console.log(error);
                history.push("/");
              });
            }
        
          }, []);

    return null

};

export default CheckToken;