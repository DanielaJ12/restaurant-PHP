<section id="section">
    <div class="cont">
        <div class="user singinBx">
            <div class="imgBx"><img src="img/log1.jpg"></div>
            <div class="formBx">
                <form method="post" action="login.php">
                    <span style="position: absolute; right : 30px; top :30px; cursor: pointer;"><i onclick="toggle()" class="fas fa-times-circle"></i></span>
                    <h2>Logare</h2>
                    <input required type="text" name="user" placeholder="Utilizator">
                    <input required type="password" name="password" placeholder="Parola">
                    <input type="submit" name="submit" value="Logheaza-te">
                    <p class="signup">Nu ai cont?<a href="#" onclick="toggleForm();"> Inregistreaza-te</a></p>
                    <!--<p class="signup">Ai uitat parola?<a href="#" onclick="toggleForm();"> Click aici</a></p>-->

                </form>
            </div>
        </div>
        <div class="user singupBx">
            <div class="formBx">
                <form method="post" action="register.php">
                    <span style="position: absolute; right : 30px; top :30px; cursor: pointer;"><i onclick="toggle()" class="fas fa-times-circle"></i></span>
                    <h2>Creare cont</h2>
                    <input required type="text" name="name" placeholder="Nume">
                    <input required type="text" name="surname" placeholder="Prenume">
                    <input required type="text" name="email" placeholder="Email">
                    <input type="tel" name="phone" id="phone" placeholder="798-555-211" maxlength="10">
                    <input required type="text" name="address" placeholder="Adresa:Strada, număr, codpostal">
                    <input required type="text" name="user" placeholder="User">
                    <input required type="password" name="password" placeholder="Parola">
                    <input type="submit" name="submit" value="Inregistreaza-te">
                    <p class="signup">Ai deja cont?<a href="#" onclick="toggleForm();"> Autentifica-te</a></p>
                </form>
            </div>
            <div class="imgBx"><img src="img/log2.jpg"></div>
        </div>
    </div>
</section>