import React from 'react';

import Header from 'src/components/Header';
import Footer from 'src/components/Footer';

// import sass
import './style.sass';

const Signup = () => {
    return <div className="signup">
        <Header />
            <div className="signup-container">
                <form>
                    <label>
                        Pseudo :
                        <input type="text" name="name" />
                    </label>
                    <label>
                        Mail :
                        <input type="mail" name="name" />
                    </label>
                    <label>
                        Mot de passe :
                        <input type="password" name="name" />
                    </label>
                    <label>
                        Mot de passe :
                        <input type="password" name="name" />
                    </label>
                    <input type="submit" value="Envoyer" />
                </form>
            </div>
        <Footer />
        </div>
}

export default Signup