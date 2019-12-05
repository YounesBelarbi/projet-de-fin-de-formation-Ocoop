import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Form, Button, Col, Row } from 'react-bootstrap';
import ErrorMessage from "./errorMessage";
import axios from 'axios';
//import { submitSignup } from 'src/store/register/actions';

import useForm from "react-hook-form";

// import sass
import './style.sass';



const Signup = (props) => {

    // récupération du state
    // const {username, mail, birthdate, password, verifPassword} = useSelector(state => ({
    //    ...state.registerReducer,
    //  }));

    const activeState = useSelector(state => ({
        ...state.registerReducer,
    }));

    const dispatch = useDispatch();

    const [userInfo, setUserInfo] = useState({
        username: '',
        email: '',
        birth: '',
        password: '',
        password_confirmation: '',

    });


    const {
        register,
        handleSubmit,
        errors,
        setError,
        clearError,
        formState: { isSubmitting }
      } = useForm();

    const onSubmit = (data) => {
        console.log(JSON.stringify({...activeState}));
        axios.post('http://127.0.0.1:8001/api/register',
          JSON.stringify({...activeState}), {
            headers: {
                'Content-Type': 'application/json',
            }
        }
          )
          .then(function (response) {
            console.log('HTTP RESPONSE STATUT:', response.status);
            console.log('DATA:', response.data);
          })
          .catch(function (error) {
            console.log(error);
            console.log('DATA:', error.response.data);
          });
    

    //alert(JSON.stringify(data));
    dispatch({
        type: `SUBMIT_SIGNUP`
      });
    };


    

    const handleChangeInput = (event) => {
        console.log('activeState', JSON.stringify(activeState));
        const property = event.target.id;
        console.log(`CHANGE_${property.toUpperCase()}`);
        // Message d'erreur si les mots de passes ne sont pas similaires
        // console.log(password, verifPassword, property)
        // if(property == "verifpassword") {
        //     if(password !== verifPassword){
        //         setError("verifPassword", "samePassword")
        //     }
        //     else {
        //         clearError("verifPassword")
        //     }
        // }

        dispatch({
          type: `CHANGE_${property.toUpperCase()}`,
          data: event.target.value
        });

      };


    return <div className="signup">
        <div className="signup-container">
            <div className="signup-form">
                <Form onSubmit={handleSubmit(onSubmit)}>
                    <Row className="justify-content-center">
                        <Col lg={5} md={6} sm={8} xs={10}>
                        <Form.Group controlId="username">
                            <Form.Label>Pseudo* </Form.Label>
                            <Form.Control name="userName" type="text" placeholder="Pseudo" className="form-input" onChange={handleChangeInput} ref={register({ required: true })}/>
                            <ErrorMessage error={errors.userName} />
                            
                        </Form.Group>

                        <Form.Group controlId="email">
                            <Form.Label>mail*</Form.Label>
                            <Form.Control name="email" type="email" placeholder="Mail" className="form-input" onChange={handleChangeInput} ref={register({ required: true, pattern: /^\S+@\S+$/i  })}/>
                            <ErrorMessage error={errors.email} />
                            <Form.Text className="text-muted">
                                Nous ne partagerons jamais vos informations
                            </Form.Text>
                        </Form.Group>

                        <Form.Group controlId="birthdate">
                            <Form.Label>Date de naissance*</Form.Label>
                            <Form.Control name="birthdate" type="date" className="form-input" onChange={handleChangeInput} ref={register({ required: true })}/>
                            <ErrorMessage error={errors.birthdate} />
                        </Form.Group>
                        

                        <Form.Group controlId="password">
                            <Form.Label>Mot de passe*</Form.Label>
                            <Form.Control name="password" type="password" placeholder="Mot de passe" className="form-input" onChange={handleChangeInput} ref={register({ required: true })}/>
                            <ErrorMessage error={errors.password} />
                        </Form.Group>

                        <Form.Group controlId="verifpassword">
                            <Form.Label>Mot de passe*</Form.Label>
                            <Form.Control name="verifPassword" type="password" placeholder="Mot de passe" className="form-input" onChange={handleChangeInput} ref={register({ required: true })}/>
                            <ErrorMessage error={errors.verifPassword} />
                        </Form.Group>

                        <Form.Group controlId="formBasicCheckbox">
                            <Form.Check name="checkbox" type="checkbox" label="J'accepte les conditions générales d'utilisation" ref={register({ required: true })}/>
                            <ErrorMessage error={errors.checkbox} />
                        </Form.Group>
                        </Col>
                    </Row>
                    <Row className="justify-content-center">
                        <Col lg={3} md={6} sm={8} xs={10}>  
                            <Button variant="primary" type="submit" className="btn-main btn-submit">
                                s'inscrire
                            </Button>
                        </Col>
                    </Row>   
                </Form> 
            </div>
        </div>
    </div>;
};

export default Signup