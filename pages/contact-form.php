           
                <div class="row" id="form_container">
                    <form method="post" id="reused_form">
                        <div class="col-xs-12">
                            <input type="text" class="col-xs-12" name="title" placeholder="Naslov" required>
                        </div>
                        <div class="col-xs-12">
                            <textarea class="col-xs-12" name="message" id="message" maxlength="6000" rows="7" placeholder="Poruka" required></textarea>
                        </div>
                        <div class="col-xs-12 flex f-wrap j-sbet">    
                            <input type="text" id="name" name="name" placeholder="Ime i prezime" required>
                            <input type="email" id="email" name="email" placeholder="Email" required>
							<input type="tel" id="telefon" name="telefon" placeholder="Broj telefona" required>
                            <button type="submit" class="btn btn-lg" >Pošalji &rarr;</button>
                        </div>
                    </form>
                    <div id="success_message"> <h3>Poruka uspješno poslana!</h3> </div>
                    <div id="error_message"> <h3>Greška:</h3> Ispunite sva polja i pokušajte ponovno. </div>
                </div>