<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>CGV</title>
</head>
<body>
   <?php session_start(); ?>
   <?php include("./include/header.php"); ?>
   <?php

      echo('<div class="infosContainer">');

         if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

            echo('<h2 class="infosTitle">Terms and conditions of sale</h2>');

            echo('<hr>');

            echo('<p><b><i>The Advisory Commission on Trade Practices recommends that suppliers of products or services adopt general conditions of sale established according to the needs of each, based on the model proposed below : </i></b></p>');

            echo('<h2>1 - Conclusion of contract</h2>');

            echo('<p>Any order of products implies the adhesion without reserve to the present general conditions of sale, supplemented or arranged by our particular conditions, which cancel any contrary clause which can appear in the conditions of purchase, purchase orders, or other commercial documents.</p>');

            echo('<h2>2 - Price</h2>');

            echo('<p>The goods are invoiced at the rate in force on the day the order is placed. <br/>
               The general price list is attached to these conditions. <br/>
               Prices may be revised subject to 30 days\' prior notice.</p>');

            echo('<h2>3 - Delivery</h2>');

            echo('<p>Delivery shall be made either by direct delivery of the product to the Buyer, or by notice of availability, or by delivery to a shipper or carrier at the Seller\'s premises or at any other designated premises. <br/>
               The verification of the goods by the purchaser must be carried out at the time of their taking in charge. <br/>
               In the event of damage or of missing, of complaints on the apparent defects or the nonconformity of the delivered product, the purchaser will emit clear and precise reserves which it will notify within three days, following the date of delivery in writing near the salesman or the conveyor. <br/>
               It will be up to the purchaser to provide any justification as for the reality of the noted anomalies.</p>');

            echo('<h2>4 - Delivery times</h2>');

            echo('<p>The delivery times are indicated according to the availability of supply. <br/>
               Except case of absolute necessity (war, riot, fire, total or partial strike), in the event of delay of delivery of a duration higher than 72h after the indicative date of delivery, the purchaser will have the option of cancelling his order, without being able to claim with some allowance that it is.</p>');

            echo('<h2>5 - Feedback</h2>');

            echo('<p>Any return of product must be the subject of a formal agreement between the salesman and the purchaser. </p>');

            echo('<h2>6 - Guarantee</h2>');

            echo('<p>The seller will take the utmost care in the execution of the order and the quality of the products. <br/>
               In the event of a defect recognized by the seller, the seller\'s obligation shall be limited to the replacement or refund of the defective quantities, without further compensation. <br/>
               Defects and damage resulting from storage, handling, transport or use under abnormal conditions or conditions not in accordance with the nature, requirements and suitability of the product are excluded from the warranty.</p>');

            echo('<h2>7 - Payment</h2>');

            echo('<p>Except for special conditions, invoices are payable from the date of delivery. In the event of late payment, the seller may suspend all pending orders. <br/>
               Any sum not paid with the expiry appearing on the invoice involves automatically the application of penalties of an amount equal to one and a half times the legal interest. <br/>
               These penalties shall be payable on demand by the seller. <br/>
               No discount is accepted for early payment.</p>');

            echo('<h2>8 - Resolutive clause</h2>');

            echo('<p>In case of non-payment, forty-eight hours after a formal notice remained unsuccessful, the sale will be terminated by right by the seller who will be able to ask in summary proceedings for the restitution of the products without prejudice to all other damages and interests. <br/>
               The sums remaining due for other deliveries will become immediately payable if the seller does not opt to cancel the corresponding orders.</p>');

            echo('<h2>9 - Reservation of ownership</h2>');

            echo('<p>The sold goods remain the property of the salesman until the complete payment of their price. <br/>
               However the risks relating to the goods will be transferred to the purchaser or the conveyor, as of the physical handing-over of the products. </p>');

            echo('<h2>10 - Attribution of jurisdiction</h2>');

            echo('<p>The present conditions cancel and replace the previously applicable conditions. Any dispute relating to these terms and conditions shall be referred to the Mixed Commercial Court.</p>
               <p><b><u>Warning :</u> This standard model of general conditions of sale does not commit the administration. <br/>
               It is the responsibility of professionals to ensure that their GTCs comply with the provisions of the modified deliberation n°14 of 6/10/2004.</b></p>');

         } else {

            echo('<h2 class="infosTitle">Conditions générales de vente</h2>');

            echo('<hr>');

            echo('<p><b><i>La commission consultative des pratiques commerciales recommande que les fournisseurs de produits ou de prestations de services se dotent de conditions générales de vente établies selon les besoin de chacun, à partir du modèle proposé ci-après : </i></b></p>');

            echo('<h2>1 - Conclusion du contrat</h2>');

            echo('<p>Toute commande de produits implique l\'adhésion sans réserve aux présentes conditions générales de vente, complétées ou aménagées par nos conditions particulières, qui annulent toute clause contraire pouvant figurer dans les conditions d\'achat, bons de commande, ou autres documents commerciaux.</p>');

            echo('<h2>2 - Prix</h2>');

            echo('<p>Les marchandises sont facturées au tarif en vigueur au jour de la passation de la commande. <br/>
               Le tarif général est annexé aux présentes conditions. <br/>
               Les prix peuvent être révisés sous réserve d\'une information préalable de 30 jours.</p>');

            echo('<h2>3 - Livraison</h2>');

            echo('<p>La livraison est effectuée soit par la remise directe du produit à l\'acquéreur, soit par avis de mise à disposition, soit par délivrance à un expéditeur ou à un transporteur dans les locaux du vendeur ou dans tous autres locaux désignés. <br/>
               La vérification des marchandises par l\'acheteur doit être effectuée au moment de leur prise en charge. <br/>
               En cas d\'avarie ou de manquant, de réclamations sur les vices apparents ou sur la non-conformité du produit livré, l\'acheteur émettra des réserves claires et précises qu\'il notifiera dans un délai de trois jours, suivant la date de livraison par écrit auprès du vendeur ou du transporteur. <br/>
               Il appartiendra à l\'acheteur de fournir toute justification quant à la réalité des anomalies constatées.</p>');

            echo('<h2>4 - Délais de livraison</h2>');

            echo('<p>Les délais de livraison sont indiqués en fonction des disponibilités d\'approvisionnement. <br/>
               Sauf cas de force majeure (guerre, émeute, incendie, grève totale ou partielle), en cas de retard de livraison d\'une durée supérieure à 72h après la date indicative de livraison, l\'acheteur aura l\'option d\'annuler sa commande, sans pouvoir prétendre à quelque indemnité que ce soit.</p>');

            echo('<h2>5 - Retours</h2>');

            echo('<p>Tout retour de produit doit faire l\'objet d\'un accord formel entre le vendeur et l\'acquéreur. </p>');

            echo('<h2>6 - Garantie</h2>');

            echo('<p>Le vendeur apportera le plus grand soin à l\'exécution de la commande et à la qualité des produits. <br/>
               En cas de défectuosité reconnue par le vendeur, l\'obligation de ce dernier sera limitée au remplacement ou au remboursement des quantités défectueuses, sans autre indemnité. <br/>
               Sont exclus de la garantie les défauts et dommages résultant d\'un stockage, de manutention, de transport ou d\'utilisation dans des conditions anormales ou non conformes avec la nature, les prescriptions, l\'aptitude à l\'emploi du produit.</p>');

            echo('<h2>7 - Paiement</h2>');

            echo('<p>Sauf conditions particulières, les factures sont payables à compter de la date de livraison. En cas de retard de paiement, le vendeur pourra suspendre toutes les commandes en cours. <br/>
               Toute somme non payée à l\'échéance figurant sur la facture entraîne de plein droit l\'application de pénalités d\'un montant égal à une fois et demie l\'intérêt légal. <br/>
               Ces pénalités seront exigibles sur simple demande du vendeur. <br/>
               Aucun escompte n\'est accepté pour paiement anticipé.</p>');

            echo('<h2>8 - Clause résolutoire</h2>');

            echo('<p>En cas de défaut de paiement, quarante huit heures après une mise en demeure restée infructueuse, la vente sera résiliée de plein droit par le vendeur qui pourra demander en référé la restitution des produits sans préjudice de tous autres dommages et intérêts. <br/>
               Les sommes restant dues pour d\'autres livraisons deviendront immédiatement exigibles si le vendeur n\'opte pas pour la résolution des commandes correspondantes.</p>');

            echo('<h2>9 - Réserve de propriété</h2>');

            echo('<p>Les marchandises vendues restent la propriété du vendeur jusqu\'au complet règlement de leur prix. <br/>
               Toutefois les risques afférents aux marchandises seront transférés à l\'acheteur ou au transporteur, dès la remise physique des produits. </p>');

            echo('<h2>10 - Attribution de juridiction</h2>');

            echo('<p>Les présentes conditions annulent et remplacent les conditions précédemment applicables. Tout litige relatif aux présentes sera de la compétence du tribunal mixte de commerce.</p>
            <p><b><u>Attention :</u> Ce modèle type de conditions générales de vente n’engage en aucun cas l’administration. <br/>
                  Il appartient aux professionnels de s’assurer que leurs CGV sont conformes aux dispositions de la délibération modifiée n°14 du 6/10/2004.</b></p>');

         }

      echo('</div>');

   ?>

   <?php include("./include/footer.php"); ?>
</body>
</html>