<?php
/**
 * @description basic terms of service page
 * @return void
 */
function tOSView()
{
    $title = "Terms";
    // Content
    ob_start();
?>
    <div class="mx-5 my-3">
        <h1>Terms and conditions</h1>
        <p>These terms and conditions (&quot;Agreement&quot;) set forth the general terms and conditions of your use of the <a target="_blank" rel="nofollow" href="http://photify.ch">photify.ch</a> website (&quot;Website&quot; or &quot;Service&quot;) and any of its related products and services (collectively, &quot;Services&quot;). This Agreement is legally binding between you (&quot;User&quot;, &quot;you&quot; or &quot;your&quot;) and this Website operator (&quot;Operator&quot;, &quot;we&quot;, &quot;us&quot; or &quot;our&quot;). By accessing and using the Website and Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Agreement. If you are entering into this Agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this Agreement, in which case the terms &quot;User&quot;, &quot;you&quot; or &quot;your&quot; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this Agreement, you must not accept this Agreement and may not access and use the Website and Services. You acknowledge that this Agreement is a contract between you and the Operator, even though it is electronic and is not physically signed by you, and it governs your use of the Website and Services. This terms and conditions policy was created with the help of the <a target="_blank" href="https://www.websitepolicies.com/terms-and-conditions-generator">terms and conditions generator</a>.</p>
        <h2>Accounts and membership</h2>
        <p>If you create an account on the Website, you are responsible for maintaining the security of your account and you are fully responsible for all activities that occur under the account and any other actions taken in connection with it. We may, but have no obligation to, monitor and review new accounts before you may sign in and start using the Services. Providing false contact information of any kind may result in the termination of your account. You must immediately notify us of any unauthorized uses of your account or any other breaches of security. We will not be liable for any acts or omissions by you, including any damages of any kind incurred as a result of such acts or omissions. We may suspend, disable, or delete your account (or any part thereof) if we determine that you have violated any provision of this Agreement or that your conduct or content would tend to damage our reputation and goodwill. If we delete your account for the foregoing reasons, you may not re-register for our Services. We may block your email address and Internet protocol address to prevent further registration.</p>
        <h2>User content</h2>
        <p>We do not own any data, information or material (collectively, &quot;Content&quot;) that you submit on the Website in the course of using the Service. You shall have sole responsibility for the accuracy, quality, integrity, legality, reliability, appropriateness, and intellectual property ownership or right to use of all submitted Content. We may, but have no obligation to, monitor and review the Content on the Website submitted or created using our Services by you. You grant us permission to access, copy, distribute, store, transmit, reformat, display and perform the Content of your user account solely as required for the purpose of providing the Services to you. Without limiting any of those representations or warranties, we have the right, though not the obligation, to, in our own sole discretion, refuse or remove any Content that, in our reasonable opinion, violates any of our policies or is in any way harmful or objectionable. Unless specifically permitted by you, your use of the Website and Services does not grant us the license to use, reproduce, adapt, modify, publish or distribute the Content created by you or stored in your user account for commercial, marketing or any similar purpose.</p>
        <h2>Backups</h2>
        <p>We perform regular backups of the Website and its Content, however, these backups are for our own administrative purposes only and are in no way guaranteed. You are responsible for maintaining your own backups of your data. We do not provide any sort of compensation for lost or incomplete data in the event that backups do not function properly. We will do our best to ensure complete and accurate backups, but assume no responsibility for this duty.</p>
        <h2>Links to other resources</h2>
        <p>Although the Website and Services may link to other resources (such as websites, mobile applications, etc.), we are not, directly or indirectly, implying any approval, association, sponsorship, endorsement, or affiliation with any linked resource, unless specifically stated herein. We are not responsible for examining or evaluating, and we do not warrant the offerings of, any businesses or individuals or the content of their resources. We do not assume any responsibility or liability for the actions, products, services, and content of any other third parties. You should carefully review the legal statements and other conditions of use of any resource which you access through a link on the Website and Services. Your linking to any other off-site resources is at your own risk.</p>
        <h2>Changes and amendments</h2>
        <p>We reserve the right to modify this Agreement or its terms relating to the Website and Services at any time, effective upon posting of an updated version of this Agreement on the Website. When we do, we will revise the updated date at the bottom of this page. Continued use of the Website and Services after any such changes shall constitute your consent to such changes.</p>
        <h2>Acceptance of these terms</h2>
        <p>You acknowledge that you have read this Agreement and agree to all its terms and conditions. By accessing and using the Website and Services you agree to be bound by this Agreement. If you do not agree to abide by the terms of this Agreement, you are not authorized to access or use the Website and Services.</p>
        <h2>Contacting us</h2>
        <p>If you would like to contact us to understand more about this Agreement or wish to contact us concerning any matter relating to it, you may send an email to pho&#116;&#105;&#102;y&#46;&#101;&#110;&#116;&#101;&#114;&#112;r&#105;s&#101;&#64;gma&#105;l&#46;&#99;&#111;m.</p>
        <p>This document was last updated on March 15, 2021</p>
    </div>
<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    renderTemplate($title, $content);
}
