<h1>Usuários</h1>


<form id="user-form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=user/create" method="post">
<fieldset>
    <legend>Informações</legend>

    <h2>Inputs &amp; Datepicker</h2>
    <p>
        <label>Login:</label>
        <input class="sf" name="User[login]" type="text" value="<?if(isset($model)){ echo $model['login']; }?>" />
    </p>

    <p>
        <label>Nome:</label>
        <input class="sf" name="User[name]" type="text" value="<?if(isset($model)){ echo $model['name']; }?>" />
    </p>

    <p>
        <label>Senha:</label>
        <input class="sf" name="User[pass]" type="password" value="<?if(isset($model)){ echo $model['pass']; }?>" />
    </p>
    
    <p><input class="button" type="submit" value="Salvar" /> <input class="button" type="reset" value="Resetar" /></p>
</fieldset>
</form>