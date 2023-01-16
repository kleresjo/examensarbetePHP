<?php // http://localhost:8888/

require_once __DIR__ . "/classes/Template.php";

Template::header("Arkeologishoppen"); 
?>

<div class="index-div">
    <h2 class="index-title"> Om Arkeologishoppen </h2>
    <p class="index-p">
    Arkeologishoppen är en specialiserad webbutik som i första hand riktar sig till arkeologer, 
    osteologer och projektledare inom all arkeologisk verksamhet i Sverige och inom EU. 
    Företaget startade 2023 och tillhandahåller större och mindre verktyg samt dokumentationsmateriell 
    till arkeologiska utgrävningar i syfte att underlätta arbetet för arkeologer i fält och osteologen på labbet. 
    Efterbearbetning eller fyndhanteringen av artefakter och benmaterial är oerhört viktigt och Arkeologishoppen
    sortiment kan bistå i att underlätta arbetet med även detta.
    </p>
</div>
<div>
    <img src="/assets/uploads/photo-1554303486-cb4b90a27751.webp" alt="" class="index-img">
</div>
<?php
Template::footer();