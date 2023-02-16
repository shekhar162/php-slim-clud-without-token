1 ) add record
method : post
Url : http://localhost/slim37y/public/user/add
data : 
{
    "userName": "shekhar",
    "emailId": "shekhar@gmail.com",
    "mobNo": "123456789"
}

2 ) get data
method : get
url : http://localhost/slim37y/public/user

3 ) get specific record
Method : post
url : http://localhost/slim37y/public/user
data: 
{
    "id":"2"
}

4) delete
Method : delete
url : http://localhost/slim37y/public/user/1

5 ) update
Method : put
url : http://localhost/slim37y/public/user/update
data:
{
    "identifier" : {
        "id" : "2"
    },
    "data" : {
        "userName" : "raja"
    }
}