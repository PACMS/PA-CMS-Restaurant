<main class="login">
    <section id="bg-image-login">
    </section>
    <section class="login">
        <div class="container-login">
            <h1>Connexion</h1>
            <form method="post" action="loginVerify" class="flex flex-column">
                <label for="email" class="greytext">Adresse mail</label>
                <input type="email" name="email" />
                <div class="flex justify-content-between align-items-center">
                    <label for="password">Mot de passe</label>
                    <a href="lostPassword">Mot de passe oublié ?</a>
                </div>
                <div class="password-icon flex align-items-center">
                    <input id="login-input-password" type="password" name="password" />
                    <i id="togglePassword" class="far fa-eye"></i>
                </div>
                <input type="submit" value="Connexion" />
            </form>
            <p>Se connecter avec</p>
            <div class="options-auth flex">
                <a href='https://accounts.google.com/o/oauth2/v2/auth?scope=<?php echo urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') ?>&access_type=offline&response_type=code&redirect_uri=<?php echo urlencode(REDIRECT_URI_GOOGLE) ?>&client_id=<?php echo PUBLIC_KEY_GOOGLE ?>'>
                    <article class="flex justify-content-center align-items-center">
                        <figure>
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32C24.8366 32 32 24.8366 32 16Z" fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23.8299 16.1818C23.8299 15.6146 23.779 15.0691 23.6845 14.5455H16.1499V17.64H20.4554C20.2699 18.64 19.7063 19.4873 18.859 20.0546V22.0619H21.4445C22.9572 20.6691 23.8299 18.6182 23.8299 16.1818Z" fill="#4285F4" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1496 24C18.3096 24 20.1205 23.2836 21.4442 22.0618L18.8587 20.0545C18.1423 20.5345 17.226 20.8181 16.1496 20.8181C14.066 20.8181 12.3023 19.4109 11.6732 17.52H9.00049V19.5927C10.3169 22.2072 13.0223 24 16.1496 24Z" fill="#34A853" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6735 17.52C11.5135 17.04 11.4226 16.5272 11.4226 16C11.4226 15.4727 11.5135 14.96 11.6735 14.48V12.4072H9.00081C8.45899 13.4872 8.1499 14.709 8.1499 16C8.1499 17.2909 8.45899 18.5127 9.00081 19.5927L11.6735 17.52Z" fill="#FBBC05" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1496 11.1818C17.3241 11.1818 18.3787 11.5855 19.2078 12.3782L21.5023 10.0836C20.1169 8.79273 18.306 8 16.1496 8C13.0223 8 10.3169 9.79273 9.00049 12.4073L11.6732 14.48C12.3023 12.5891 14.066 11.1818 16.1496 11.1818Z" fill="#EA4335" />
                            </svg>
                        </figure>
                        <p>Google</p>
                    </article>
                </a>
                <a href='https://www.facebook.com/v13.0/dialog/oauth?client_id=<?php echo PUBLIC_KEY_FACEBOOK ?>&redirect_uri=<?php echo urlencode(REDIRECT_URI_FACEBOOK) ?>&scope=email'>
                    <article class="flex justify-content-center align-items-center">
                        <figure>
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 16C0 24.8366 7.16344 32 16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16Z" fill="#1877F2" />
                                <path d="M24 16C24 11.6 20.4 8 16 8C11.6 8 8 11.6 8 16C8 20 10.9 23.3 14.7 23.9V18.3H12.7V16H14.7V14.2C14.7 12.2 15.9 11.1 17.7 11.1C18.6 11.1 19.5 11.3 19.5 11.3V13.3H18.5C17.5 13.3 17.2 13.9 17.2 14.5V16H19.4L19 18.3H17.1V24C21.1 23.4 24 20 24 16Z" fill="white" />
                            </svg>
                        </figure>
                        <p>Facebook</p>
                    </article>
                </a>
            </div>
            <p>Vous n'avez pas de compte ? <a href="/register">Créez en un !</a></p>
        </div>
    </section>
</main>
