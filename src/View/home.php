<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<div class="container">
    <section class="search">
        <div class="logo-recherche">
            <div class="logo-main"></div>
            <!-- <img src="pictures/logo-main.PNG" alt="logo-main"> -->
            <div class="logo-recherche-btn">
                <input type="text" placeholder="Rechercher....">
                <button class="recherche" type="button">
                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </section>

    <section class="qui-sommes-nous">
        <h1>Qui sommes-nous ?</h1>
        <p>Eclaireurs Solidaires est une association qui a été fondée par Claire MONNIER en 2020
            à Lyon dont le but principal est de faciliter l'engagement bénévole ponctuel
            ou régulier dans des actions sociales, écologiques et culturelles.
            Cette ancienne éducatrice spécialisée passionnée par l'engagement citoyen depuis
            son adolescence a développé son réseau de partenaires entre 2020 et 2023.
        </p>
    </section>

    <section class="central">
        <div class="bloc-milieu">
            <div class="engagmnt">
                <div class="engage">
                    <h3>L'engagement se transforme. Et vous ?</h3>
                    <p>Découvrez notre expertise et nos solutions pour accompagner
                        tous les acteurs associatifs dans la transformation de
                        l'engagement.
                        Créons ensemble une société solidaire.
                    </p>
                </div>
            </div>

            <div class="eclaireur solidarite">
                <div class="solidari"></div>
                <!-- <img src="pictures/Solidarite.jpg" alt=""> -->
                <div class="text">
                    <h3>Solidarité</h3>
                    <p>Les actions solidaires sont des initiatives collectives
                        visant à offrir une aide mutuelle et un soutien aux personnes
                        ou communautés en situation de besoin.
                        En participant à des actions solidaires, chacun contribue
                        activement à renforcer les liens communautaires et à promouvoir
                        l'entraide, des valeurs essentielles dans toute société.
                    </p>
                </div>
            </div>

            <div class="eclaireur engagem">
                <div class="enggmt"></div>
                <!-- <img src="pictures/engage.jpg" alt=""> -->
                <div class="text">
                    <h3>Engagement</h3>
                    <p>L'engagement bénévole associatif participe au développement
                        d'une société plus solidaire et fraternelle, attachée à servir
                        l'intérêt général et le bien commun, et favorise l'expression
                        d'une conscience citoyenne attentive à la construction d'un
                        « vivre ensemble » respectueux de sa diversité. L'engagement
                        associatif bénévole est un levier d'inclusion sociale.
                    </p>
                </div>
            </div>

            <div class="eclaireur benevolat">
                <div class="benevol"></div>
                <!-- <img src="pictures/benevolat.PNG" alt=""> -->
                <div class="text">
                    <h3>Bénévolat</h3>
                    <p>Que ce soit pour agir au service des autres, défendre des
                        causes qui vous tiennent à cœur, ou simplement partager
                        vos compétences, le bénévolat est une formidable opportunité
                        de donner du sens à votre temps libre.
                        S'impliquer dans une association, c'est offrir une partie
                        de son temps sans rémunération, mais avec une vraie reconnaissance.
                    </p>
                </div>
            </div>

            <div class="eclaireur missio">
                <div class="missn"></div>
                <!-- <img src="pictures/missions.jpg" alt=""> -->
                <div class="text">
                    <h3>Missions</h3>
                    <p>La raison d'être de l'association est de faire vivre la solidarité
                        au quotidien, pour redonner le sourire aux enfants défavorisés.
                        L'objectif est de permettre à des enfants en difficulté de participer
                        à des activités et sorties culturelles, sportives, artistiques, scolaires
                        ou ludiques dans lesquelles ils peuvent s'épanouir.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="dmd-renseigmnt">
            <h2>Demande de renseignements</h2>
            <p>Notre équipe est passionnée et sera ravie de vous aider à trouver
                l'opportunité de volontariat idéale pour vos ambitions.
                Un certain nombre de nos employés ont eux-mêmes fait du volontariat à l'étranger.
                Nous sommes donc bien placés pour comprendre votre enthousiasme et pouvons
                répondre à toutes les questions que vous vous posez.
            </p>
        </div>

        <form class="formulaire" action="#" method="POST">
            <div class="firstn">
                <label for="firstname">Prénoms</label>
                <input type="text" id="firstname" name="firstname">
            </div>

            <div class="lastn">
                <label for="lastname">Nom de famille</label>
                <input type="text" id="lastname" name="lastname">
            </div>

            <div class="mail">
                <label for="mail">Votre email</label>
                <input type="email" id="mail" name="email" required>
            </div>

            <div class="numtel">
                <label for="tel">Numéro de téléphone</label>
                <div class="numerotel">
                    <select id="country" name="country">
                        <option value="france">FRANCE</option>
                        <option value="belgique">BELGIQUE</option>
                        <option value="italie">ITALIE</option>
                        <option value="espagne">ESPAGNE</option>
                        <option value="allemagne">ALLEMAGNE</option>
                        <option value="suisse">SUISSE</option>
                        <option value="autriche">AUTRICHE</option>
                        <option value="hors_ue">Hors UE</option>
                    </select>
                    <input type="tel" id="tel" name="tel">
                </div>
            </div>

            <div class="mess">
                <label for="message">Votre message</label>
                <div class="messa">
                    <textarea id="message" name="message"></textarea>
                </div>
            </div>

            <div class="check">
                <div>
                    <input type="checkbox" id="sms_optin" name="sms_optin" />
                    <label for="sms_optin">J'accepte de recevoir les communications par SMS</label>
                </div>

                <div>
                    <input type="checkbox" id="mail_optin" name="mail_optin" />
                    <label for="mail_optin">J'accepte de recevoir les communications par mail</label>
                </div>
            </div>
            
            <input class="envoie" type="submit" value="Envoyer">
        </form>
    </section>

    <div class="text-client">
        <h2>AVIS CLIENT</h2>
    </div>

    <section class="client">
        <div class="avis">
            <img src="src/public/picture/photo-avis client 3.png" alt="Avis de David">
            <p>
                Un outil très adapté aux activités associatives,
                intuitif et convivial pour trouver de nouvelles missions.<br>
                Je recommande fortement.<br><br>
                David
            </p>
            <div class="notes">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>

        <div class="avis">
            <img src="src/public/picture/photo-avis client 1.png" alt="Avis de Camille">
            <p>
                Je vous remercie grandement pour votre aide
                et votre flexibilité.
                Vraiment mille mercis.<br><br>
                Camille
            </p>
            <div class="notes">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>

        <div class="avis">
            <img src="src/public/picture/photo-avis client 2.png" alt="Avis client">
            <p>
                Un outil très adapté aux activités associatives,
                intuitif et convivial pour trouver de nouvelles missions.<br>
                Je recommande fortement.<br><br>
                David
            </p>
            <div class="notes">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>
    </section>

</div>

<?php
require_once 'src/View/partial/_footer.php';
?>