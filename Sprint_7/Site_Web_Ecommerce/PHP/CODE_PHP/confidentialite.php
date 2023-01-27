<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Politique de confidentialité</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>

    <?php

        echo('<div class="infosContainer">');

            if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

                echo('<h2 class="infosTitle">Privacy Policy for Art\'i\'Chaude website</h2>');
            
                echo('<hr>');

                echo('<p>The company Art\'i\'Chaude (whose head office is located in Bordeaux), in its capacity as data controller, attaches great importance to the protection and respect of your private life. <br/>
                The purpose of this policy is to inform you, in accordance with Regulation No. 2016-679 of 27 April 2016 on the protection of individuals with regard to the processing of personal data and on the free movement of such data (hereinafter referred to as the "Regulation"), of our practices regarding the collection, use and sharing of information that you may provide to us.</p>
                <p>The purpose of this policy is to inform you about the categories of personal data we may collect or hold about you, how we use it, who we share it with, how long we keep it and how we protect it, and what rights you have over your personal data.</p>');

                echo('<h2>1 - Data we collect</h2>');

                echo('<p>By using the Art\'i\'Chaude website, you are led to transmit information to us, some of which are likely to identify you and therefore constitute personal data (hereinafter referred to as "data").</p>
                <p>This information includes the following data :</p>');

                echo('<ul>
                    <li><p><b>Account data : </b>means the information you provide when you create an account by filling out the registration form. </p></li>
                    <li><p><b>Data made public : </b>means all of the information that you voluntarily post on the site such as comments on blogs and forums, photos, forum discussions, and account profiles.</p></li>
                    <li><p><b>Transaction Data : </b>where applicable, means the data you provide when you make purchases through the Site, such as information about your payment method. <br/>
                        The banking data collected is transmitted to third parties who help to process and satisfy your requests. </p></li>
                    <li><p><b>Navigation Data : </b>refers to data that we collect during your navigation on the site, such as the date and time of the connection and/or navigation, the type of browser, the language of the browser and its IP address. </p></li>
                </ul>');

                echo('<h2>2 - How do we use the data we collect?</h2>');

                echo('<p id="test">We use the data we collect to : </p>');

                echo('<table>
                    <thead>
                        <tr>
                            <th class="cellsInfos headInfos">Goals</th>
                            <th class="cellsInfos headInfos">Legal basis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Create your account online,</p></li>
                                    <li><p>To carry out the contracts concluded between you and us,</p></li>
                                    <li><p>Manage the commercial relationship (deliveries, invoices, after sales services)</p></li>
                                </ul>
                            </td>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Performance of a contract or execution of pre-contractual measures,</p></li>
                                    <li><p>Consent,</p></li>
                                    <li><p>Compliance with a legal obligation to which the data controller is subject,</p></li>
                                    <li><p>Safeguarding the vital interests of the person concerned,</p></li>
                                    <li><p>Performance of a mission of public interest or in the exercise of public authority vested in the controller,</p></li>
                                    <li><p>Legitimate interests pursued by the controller unless the interests or fundamental rights and freedoms of the data subject prevail.</p></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>');

                echo('<p>At the time of data collection, you will be informed whether certain data is mandatory or optional. <br/>
                    The data identified by an asterisk in the collection form are mandatory. <br/>
                    Failure to do so may restrict the execution of your request.</p>');

                echo('<h2>3 - Who are the recipients of the data we collect and why do we send them this data ?</h2>');

                echo('<h3>3.1 - Data processed by Art\'i\'Chaude</h3>');

                echo('<p>The data collected are intended for us in our capacity as data controller :</p>');
                
                echo('<table>
                    <thead>
                        <tr>
                            <th class="cellsInfos headInfos">Goals</th>
                            <th class="cellsInfos headInfos">Department or person in charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Create your account online,</p></li>
                                    <li><p>To carry out the contracts concluded between you and us,</p></li>
                                    <li><p>Manage the commercial relationship (deliveries, invoices, after sales services)</p></li>
                                </ul>
                            </td>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>IT department / Webmaster,</p></li>
                                    <li><p>Commercial service,</p></li>
                                    <li><p>Service marketing,</p></li>
                                    <li><p>and so on.</p></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>');

                echo('<h3>3.2 - Data transferred to public authorities and/or bodies</h3>');

                echo('<p>In accordance with the regulations in force, the data may be transmitted to the competent authorities on request and in particular to public bodies, judicial officers, legal officers, bodies responsible for collecting debts, exclusively to meet legal obligations, as well as in the case of research into the authors of offences committed on the Internet.</p>');

                echo('<h2>4 - How long do we keep your data?</h2>');

                echo('<p>Your data will not be kept longer than is strictly necessary for the purposes set out in this policy and in accordance with applicable laws and regulations.</p>');

                echo('<table>
                    <thead>
                        <tr>
                            <th class="cellsInfos headInfos">Goals</th>
                            <th class="cellsInfos headInfos">Shelf life</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Create your account online,</p></li>
                                    <li><p>To carry out the contracts concluded between you and us,</p></li>
                                    <li><p>Manage the commercial relationship (deliveries, invoices, after sales services)</p></li>
                                </ul>
                            </td>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Maximum 2 years.</p></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>');

                echo('<p>When the retention periods expire, your data is deleted or anonymized so that it can be used without infringing your rights. <br/> 
                    Nevertheless, your data may be archived beyond the periods provided for the needs of research, the establishment and prosecution of criminal offenses for the sole purpose of allowing, as necessary, the provision of your data to the judicial authority.</p>
                    <p>Archiving implies that your data will no longer be available online but will be extracted and stored on an autonomous and secure medium.</p>');

                echo('<h2>5 - Is your data transferred, how and where?</h2>');

                echo('<p>Your data will not be transferred outside the European Union.</p>');

                echo('<h2>6 - How is your data protected ?</h2>');

                echo('<p>We take appropriate technical and organizational measures to prevent unauthorized access to or modification, disclosure, loss or destruction of your data.</p>
                <p>It is important that you maintain the confidentiality of your credentials in order to prevent unauthorized use of your account.</p>');

                echo('<h2>7 - What are your rights regarding your data ?</h2>');

                echo('<p>In accordance with applicable data protection laws and regulations, you have a number of rights with respect to your data, including :</p>');

                echo('<ul>
                    <li><p><b>Right of access and information :</b> you have the right to be informed in a concise, transparent, intelligible and easily accessible manner of how your data is processed. <br/>
                        You also have the right to obtain confirmation that data concerning you is being processed and, if necessary, to access this data and obtain a copy.</p></li>
                    <li><p><b>Right of rectification :</b> you have the right to obtain the correction of inaccurate data concerning you. <br/>
                        You also have the right to complete incomplete data about yourself by providing an additional declaration. <br/>
                        In case of exercise of this right, we undertake to communicate any rectification to all recipients of your data.</p></li>
                    <li><p><b>Right of erasure :</b> in some cases, you have the right to have your data erased. <br/>
                        However, this is not an absolute right and we may for legal or legitimate reasons retain this data.</p></li>
                    <li><p><b>Right to limit processing :</b> in some cases, you have the right to obtain the limitation of the processing on your data.</p></li>
                    <li><p><b>Right to data portability :</b> you have the right to receive your data, which you have provided to us, in a structured, commonly used and machine-readable format, for your personal use or for transmission to a third party of your choice. <br/>
                        This right only applies when the processing of your data is based on your consent, on a contract and when this processing is carried out by automated means.</p></li>
                    <li><p><b>Right to object to processing :</b> you have the right to object at any time to the processing of your data for processing based on our legitimate interest, a mission of public interest and those for commercial prospecting purposes. <br/>
                        This is not an absolute right and we may for legal or legitimate reasons refuse your request to object.</p></li>
                    <li><p><b>Right to withdraw your consent at any time :</b> you may withdraw your consent to the processing of your data where the processing is based on your consent. <br/>
                        Withdrawal of consent does not affect the lawfulness of processing based on the consent given prior to the withdrawal.</p></li>
                    <li><p><b>Right to file a complaint with a supervisory authority :</b> you have the right to contact your data protection authority to complain about our personal data protection practices.</p></li>
                    <li><p><b>Right to give instructions about what happens to your data after your death :</b> you have the right to give us instructions regarding the use of your data after your death.</p></li>
                </ul>');

                echo('<p>Please note that we may require proof of your identity to exercise these rights.</p>');

                echo('<h2>8 - Modification of our privacy policy</h2>');

                echo('<p>We may occasionally modify this policy in order to comply with any regulatory, legal, editorial or technical developments. <br/>
                    If necessary, we will change the "last updated" date and indicate the date the changes were made. <br/> 
                    When necessary, including but not limited to material changes or special events requiring the modification of this policy, we will inform you and/or seek your consent. <br/>
                    We recommend that you check this page regularly for any changes or updates to our policy.</p>');

            } else {

                echo('<h2 class="infosTitle">Politique de confidentialité pour le site web d\'Art\'i\'Chaude</h2>');
                
                echo('<hr>');

                echo('<p>La société Art\'i\'Chaude (dont le siège social est situé à Bordeaux), en sa qualité de responsable du traitement, attache une grande importance à la protection et au respect de votre vie privée. <br/>
                La présente politique vise à vous informer, conformément au Règlement n°2016-679 du 27 avril 2016 relatif à la protection des personnes physiques à l’égard du traitement des données à caractère personnel et à la libre circulation de ces données (ci-après dénommé le « règlement »), de nos pratiques concernant la collecte, l’utilisation et le partage des informations que vous êtes amenés à nous fournir.</p>
                <p>Cette politique a pour but de vous informer sur les catégories de données personnelles que nous pourrions recueillir ou détenir sur vous, comment nous les utilisons, quels en sont les destinataires et avec qui nous les partageons, la durée pendant laquelle nous les conservons et comment nous les protégeons, enfin les droits dont vous disposez sur vos données personnelles.</p>');

                echo('<h2>1 - Les données que nous collectons</h2>');

                echo('<p>En utilisant le site d\'Art\'i\'Chaude, vous êtes amenés à nous transmettre des informations, dont certaines sont de nature à vous identifier et constituent de ce fait des données à caractère personnel (ci-après dénommées les « données »).</p>
                <p>Ces informations contiennent notamment les données suivantes :</p>');

                echo('<ul>
                    <li><p><b>Données du compte : </b>désignent les données que vous renseignez lors de la création d’un compte en remplissant le formulaire d’inscription. </p></li>
                    <li><p><b>Données rendues publiques : </b>désignent l’ensemble des informations que vous affichez volontairement sur le site telles que notamment les commentaires sur les blogs et forums, photos, discussions sur les forums, et profil de compte.</p></li>
                    <li><p><b>Données sur les transactions : </b>le cas échéant, désignent les données que vous renseignez lorsque vous effectuez des achats par le biais du site telles que notamment les renseignements relatifs à votre moyen de paiement. <br/>
                        Les données bancaires collectées sont transmises à des tiers qui contribuent à traiter et à satisfaire vos demandes. </p></li>
                    <li><p><b>Données relatives à la navigation : </b>désignent les données que nous collectons lors de votre navigation sur le site telles que notamment la date, l’heure de la connexion et/ou navigation, le type de navigateur, la langue du navigateur, son adresse IP. </p></li>
                </ul>');

                echo('<h2>2 - Comment utilisons-nous les données que nous collectons ?</h2>');

                echo('<p id="test">Nous utilisons les données que nous recueillons afin de : </p>');

                echo('<table>
                    <thead>
                        <tr>
                            <th class="cellsInfos headInfos">Finalités</th>
                            <th class="cellsInfos headInfos">Base légale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Créer votre compte en ligne,</p></li>
                                    <li><p>Exécuter les contrats conclus entre vous et nous,</p></li>
                                    <li><p>Gérer la relation commerciale (livraisons, factures, services après vente)</p></li>
                                </ul>
                            </td>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Exécution d’un contrat ou exécution de mesures précontractuelles,</p></li>
                                    <li><p>Consentement,</p></li>
                                    <li><p>Respect d’une obligation légale à laquelle le responsable du traitement est soumis,</p></li>
                                    <li><p>Sauvegarde des intérêts vitaux de la personne concernée,</p></li>
                                    <li><p>Exécution d’une mission d’intérêt public ou relevant de l’exercice de l’autorité publique dont est investi le responsable du traitement,</p></li>
                                    <li><p>Intérêts légitimes poursuivis par le responsable du traitement à moins que ne prévalent les intérêts ou les libertés et droits fondamentaux de la personne concernée.</p></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>');

                echo('<p>Lors de la collecte des données, vous serez informé si certaines données doivent être obligatoirement renseignées ou si elles sont facultatives. <br/>
                Les données identifiées par un astérisque au sein du formulaire de collecte sont obligatoires. <br/>
                A défaut, l’exécution de votre demande pourra être restreinte.</p>');

                echo('<h2>3 - Qui sont les destinataires des données que nous collectons et pour quelles raisons leur transmettons-nous ces données ?</h2>');

                echo('<h3>3.1 - Données traitées par Art\'i\'Chaude</h3>');

                echo('<p>Les données collectées nous sont destinées en notre qualité de responsable du traitement :</p>');
                
                echo('<table>
                    <thead>
                        <tr>
                            <th class="cellsInfos headInfos">Finalités</th>
                            <th class="cellsInfos headInfos">Service ou responsable destinataire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Créer votre compte en ligne,</p></li>
                                    <li><p>Exécuter les contrats conclus entre vous et nous,</p></li>
                                    <li><p>Gérer la relation commerciale (livraisons, factures, services après vente)</p></li>
                                </ul>
                            </td>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Service informatique / Webmestre,</p></li>
                                    <li><p>Service commercial,</p></li>
                                    <li><p>Service marketing,</p></li>
                                    <li><p>etc.</p></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>');

                echo('<h3>3.2 - Données transférées aux autorités et/ou organismes publics</h3>');

                echo('<p>Conformément à la règlementation en vigueur, les données peuvent être transmises aux autorités compétentes sur requête et notamment aux organismes publics, aux auxiliaires de justice, aux officiers ministériels, aux organismes chargés d’effectuer le recouvrement de créances, exclusivement pour répondre aux obligations légales, ainsi que dans le cas de la recherche des auteurs d’infractions commises sur internet.</p>');

                echo('<h2>4 - Combien de temps conservons-nous vos données ?</h2>');

                echo('<p>Vos données ne seront pas conservées au-delà de la durée strictement nécessaire aux finalités poursuivies telles qu’énoncées dans la présente politique et ce conformément au règlement et aux lois applicables.</p>');

                echo('<table>
                    <thead>
                        <tr>
                            <th class="cellsInfos headInfos">Finalités</th>
                            <th class="cellsInfos headInfos">Durée de conservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Créer votre compte en ligne,</p></li>
                                    <li><p>Exécuter les contrats conclus entre vous et nous,</p></li>
                                    <li><p>Gérer la relation commerciale (livraisons, factures, services après vente)</p></li>
                                </ul>
                            </td>
                            <td class="cellsInfos">
                                <ul>
                                    <li><p>Au maximum 2 ans.</p></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>');

                echo('<p>Lorsque les durées de conservation arrivent à leur terme, vos sonnées sont effacées ou anonymisées de manière à pouvoir les exploiter sans porter atteinte à vos droits. <br/> 
                Néanmoins, vos données pourront être archivées au-delà des durées prévues pour les besoins de la recherche, la constatation et de la poursuite des infractions pénales dans le seul but de permettre, en tant que de besoin, la mise à disposition de vos données à l’autorité judiciaire.</p>
                <p>L’archivage implique que vos données ne seront plus consultables en ligne mais seront extraites et conservées sur un support autonome et sécurisé</p>');

                echo('<h2>5 - Vos données sont-elles transférées, comment et où ?</h2>');

                echo('<p>Vos données ne font pas l’objet de transfert hors du territoire de l’Union européenne.</p>');

                echo('<h2>6 - Comment vos données sont-elles protégées ?</h2>');

                echo('<p>Nous prenons des mesures adéquates sur le plan de la technique et de l’organisation pour interdire l’accès non autorisé ou la modification, divulgation, perte ou destruction de vos données.</p>
                <p>Il importe que vous préserviez la confidentialité de vos identifiants de façon à empêcher une utilisation illicite de votre compte.</p>');

                echo('<h2>7 - Quels sont vos droits sur vos données ?</h2>');

                echo('<p>Conformément aux lois et règlements applicables en matière de protection des données personnelles, vous bénéficiez d’un certain nombre de droits relatifs à vos données, à savoir :</p>');

                echo('<ul>
                    <li><p><b>Un droit d\'accès et d\'information :</b> vous avez le droit d’être informé de manière concise, transparente, intelligible et facilement accessible de la manière dont vos données sont traitées. <br/>
                            Vous avez également le droit d’obtenir la confirmation que des sonnées vous concernant sont traitées et, le cas échéant d’accéder à ces sonnées et d’en obtenir une copie.</p></li>
                    <li><p><b>Un droit de rectification :</b> vous avez le droit d’obtenir la rectification des données inexactes vous concernant. <br/>
                            Vous avez également le droit de compléter les données incomplètes vous concernant, en fournissant une déclaration complémentaire. <br/>
                            En cas d’exercice de ce droit, nous nous engageons à communiquer toute rectification à l’ensemble des destinataires de vos données.</p></li>
                    <li><p><b>Un droit d\'effacement :</b> dans certains cas, vous avez le droit d’obtenir l’effacement de vos données. <br/>
                            Cependant, ceci n’est pas un droit absolu et nous pouvons pour des raisons légales ou légitimes conserver ces données.</p></li>
                    <li><p><b>Un droit à la limitation du traitement :</b> dans certains cas, vous avez le droit d’obtenir la limitation du traitement sur vos données.</p></li>
                    <li><p><b>Un droit à la portabilité des données :</b> vous avez le droit de recevoir vos données que vous nous avez fournies, dans un format structuré, couramment utilisé et lisible par une machine, pour votre usage personnel ou pour les transmettre à un tiers de votre choix. <br/>
                            Ce droit ne s’applique que lorsque le traitement de vos données est basé sur votre consentement, sur un contrat et que ce traitement est effectué par des moyens automatisés</p></li>
                    <li><p><b>Un droit d’opposition au traitement :</b> vous avez le droit de vous opposer à tout moment au traitement de vos données pour les traitements basés sur notre intérêt légitime, une mission d’intérêt public et ceux à des fins de prospection commerciale. <br/>
                            Ceci n’est pas un droit absolu et nous pouvons pour des raisons légales ou légitimes refuser votre demande d’opposition.</p></li>
                    <li><p><b>Le droit de retirer votre consentement à tout moment :</b> vous pouvez retirer votre consentement au traitement de vos données lorsque le traitement est basé sur votre consentement. <br/>
                            Le retrait du consentement ne compromet pas la licéité du traitement fondé sur le consentement effectué avant ce retrait.</p></li>
                    <li><p><b>Le droit de déposer une plainte auprès d’une autorité de contrôle :</b> vous avez le droit de contacter votre autorité de protection des données pour vous plaindre de nos pratiques de protection des données personnelles.</p></li>
                    <li><p><b>Le droit de donner des directives concernant le sort de vos données après votre décès :</b> vous avez le droit de nous donner des directives concernant l’utilisation de vos données après votre décès.</p></li>
                </ul>');

                echo('<p>Notez que nous pouvons exiger un justificatif de votre identité pour l’exercice de ces droits.</p>');

                echo('<h2>8 - Modification de notre politique de confidentialité</h2>');

                echo('<p>Nous pouvons être amenés à modifier occasionnellement la présente politique, afin notamment de se conformer à toutes évolutions réglementaires, jurisprudentielles, éditoriales ou techniques. <br/>
                Le cas échéant, nous changerons la date de « dernière mise à jour » et indiquerons la date à laquelle les modifications ont été apportées. <br/> 
                Lorsque cela est nécessaire, notamment mais pas exclusivement en cas de modification substantielle ou d’évènement particulier requérant la modification de la présente politique, nous vous informerons et/ou solliciterons votre accord. <br/>
                Nous vous conseillons de consulter régulièrement cette page pour prendre connaissance des éventuelles modifications ou mises à jour apportées à notre politique.</p>');

            }

        echo('</div>');

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>