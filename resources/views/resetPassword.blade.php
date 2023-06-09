<style type="text/css">
    body{
        padding: 0;
        margin: 0;
        background: whitesmoke
    }
    .mainDiv {
        display: flex;
        min-height: 100%;
        align-items: center;
        justify-content: center;
        background-color: #f9f9f9;
        font-family: 'Open Sans', sans-serif;
    }
    .cardStyle {
        width: 500px;
        border-color: white;
        background: #fff;
        padding: 36px 0;
        border-radius: 4px;
        margin: 30px 0;
        box-shadow: 0px 0 2px 0 rgba(0,0,0,0.25);
    }
    #signupLogo {
    max-height: 100px;
    margin: auto;
    display: flex;
    flex-direction: column;
    }
    .formTitle{
    font-weight: 600;
    margin-top: 20px;
    color: #2F2D3B;
    text-align: center;
    }
    .inputLabel {
    font-size: 12px;
    color: #555;
    margin-bottom: 6px;
    margin-top: 24px;
    }
    .inputDiv {
        width: 70%;
        display: flex;
        flex-direction: column;
        margin: auto;
    }
    input {
    height: 40px;
    font-size: 16px;
    border-radius: 4px;
    border: none;
    border: solid 1px #ccc;
    padding: 0 11px;
    }
    input:disabled {
    cursor: not-allowed;
    border: solid 1px #eee;
    }
    .buttonWrapper {
    margin-top: 40px;
    }
    .submitButton {
        width: 70%;
        height: 40px;
        margin: auto;
        display: block;
        color: #fff;
        background-color: #065492;
        border-color: #065492;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }
</style>
<form method="POST">
    @csrf
    <div class="mainDiv">
        <div class="cardStyle">
            <h2 class="formTitle">
                Reset Password
            </h2>
            @if($errors->any())
                <ul>
                    @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>   
                    @endforeach
                </ul>
            @endif
            <input type="hidden" name="id" value="{{ $user[0]['id'] }}">
           
            <div class="inputDiv">
            <label class="inputLabel" for="password">New Password</label>
            <input type="password" name="password">
            </div>
            
            <div class="inputDiv">
            <label class="inputLabel" for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation">
            </div>
            
            <div class="buttonWrapper">
            <button type="submit" class="submitButton pure-button pure-button-primary">
                <span>Submit</span>
            </button>
            </div>
        </div>
    </div>
</form>