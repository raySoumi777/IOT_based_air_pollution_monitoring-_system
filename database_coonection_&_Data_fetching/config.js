const db = require("mysql");
const con= db.createConnection({
    host:"localhost",
    user:"root",
    password:"",
    database:"pollution"
})

con.connect((err)=>{
    if(err) 
        throw err;
    else{
        console.log("connect")}
})

module.exports=con