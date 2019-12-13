import React, { useState, useEffect } from 'react';
import { Form, Button, Col, Row } from 'react-bootstrap';
import ErrorMessage from "./errorMessage";
import { useSelector, useDispatch } from 'react-redux';
import { Link } from 'react-router-dom';
import axios from 'axios';

import useForm from "react-hook-form";

// Données
// Styles et assets
// import sass
import './style.sass';

const Signin = () => {

    // connexion au state du loginReducer
    const activeState = useSelector(state => ({
        ...state.loginReducer
    }));

     // connexion au state du registerReducer (afin de récuperer le mail de register reducer)
    const lastState = useSelector(state => ({
      ...state.registerReducer
    }));


    // use effect est éxécuté a chaque fois que le state de LoginReducer change
    useEffect(() => {
      console.log('lastState', lastState) //last State est égale au state de register reducer
      if(lastState.email !== ""){ //Si il est pas égale à une chaine de caractere vide on modifie le mail de login reducer
        dispatch({ // en passant par dispatch donc ->store/login/index.js
          type: `SET_EMAIL_VALUE`, //On appelle l'action SET_EMAIL_VALUE
          data: lastState.email
        })
      }
    }, []);

    // init du dispatch grace au useDispatch()
    const dispatch = useDispatch();

    // react hook form permettant un controle de formulaire grace aux hooks
    const {
        register,
        handleSubmit,
        errors,
        formState: { isSubmitting }
      } = useForm();

    // comportement à l'envoi du formulaire
    const onSubmit = (data) => {
        console.log("activeState", JSON.stringify({...activeState}));
<<<<<<< HEAD
        axios.post('http://127.0.0.1:8000/user/login',
=======
        axios.post('http://127.0.0.1:8001/user/login',
>>>>>>> 590ce5815d8f2e1359ff7dc9c2652f8a85f0be42
        JSON.stringify({...activeState}), {
          headers: {
              'Content-Type': 'application/json',
          }
        })
        .then(function (response) {
          console.log('HTTP RESPONSE STATUT:', response.status);
          console.log(response);

          if(response.status === 200) {        
            history.push("/dashboard");
          }
          else {
              console.log('error submit');
          }
          
        })
        .catch(function (error) {
          console.log(error);
        });

      };

    // comportement à la saisie des champs
    const handleChangeInput = (event) => {
        const property = event.target.id;
        console.log(`LOGIN_${property.toUpperCase()}`);
        // action envoyé au reducer 
        dispatch({
          type: `LOGIN_${property.toUpperCase()}`,
          data: event.target.value
        })
      };

    return <Form className="signup-form" onSubmit={handleSubmit(onSubmit)}>
        <Row className="justify-content-center">
            <Col lg={5} md={8} sm={10} xs={11}>
                <Form.Group controlId="email">
                <Form.Label>Adresse email</Form.Label>
                <Form.Control name="email" type="email" placeholder="Entrez email" value={activeState.email} onChange={handleChangeInput} className="form-input" ref={register({ required: true, pattern: /^\S+@\S+$/i  })}/>
                <Form.Text className="text-muted">
                <ErrorMessage error={errors.email} />
                    Nous ne partagerons jamais vos informations
                </Form.Text>
                </Form.Group>
                <Form.Group controlId="password">
                    <Form.Label>Mot de passe</Form.Label>
                    <Form.Control name="password" type="password" placeholder="Entrez mot de passe" onChange={handleChangeInput} className="form-input" ref={register({ required: true })}/>
                    <ErrorMessage error={errors.password} />
                </Form.Group>
                <Form.Group controlId="formBasicCheckbox">
                    <Form.Check type="checkbox" label="Se souvenir de moi" />
                </Form.Group>
            </Col>
        </Row>     
        <Row className="justify-content-center">
            <Col lg={3} md={6} sm={8} xs={10}>  
                <Button variant="primary" type="submit" className="btn-main btn-submit">
                    Se connecter
                </Button>
                <Link to="/resetpassword"><Form.Text> Mot de passe oublié ? </Form.Text></Link>
            </Col>
        </Row>

    </Form>
};

export default Signin