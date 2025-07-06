const express = require('express'); // importing the express modules
const con = require('./config'); // requiring the connection object
const app = express(); // initialising the express named as app
//const port = 3000;


app.use(express.urlencoded({ extended: "false" })); // decryption of content-type : "application/x-www-form-urlencoded"
app.use(express.json()); // converting the body request data in json content-type : "application/x-www-form-urlencoded"

app.get('/', (req, res) => {
    res.send(`hello world`);
})

const querystring = require('querystring');
app.post('/postData', (req, res) => {
    //console.log(req.body);
    let element;
    const data = req.body;
    console.log(data);

    for (const key in data) {
        if (Object.hasOwnProperty.call(data, key)) {
             element = data[key];
            console.log(key+" "+element)
        //    const json=JSON.stringify(element);
        //    console.log(json.split)
        const json=JSON.stringify(element);
        var co2=(json.slice(12,15))
        var ch4=(json.slice(30,33))
        var co=(json.slice(49,51))
        var nh3=(json.slice(66,68))

        var m=parseInt(json.slice(12,15))
        var n=parseInt(json.slice(30,33))
        var o=parseInt(json.slice(48,50))
        var p=parseInt(json.slice(66,69))

        //CO2 value checking
        

        var x=parseInt((m+n+o+p)/4)
        console.log(x)
            if((x<400)){

            const query = `UPDATE pollution.s05day SET SID='S05',gasname='CO2',gasvalue='${co2}',remarks='ok' where SID='S05'and gasname='CO2'`;
            con.query(query, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });
            const query2 =  `UPDATE pollution.s05day SET SID='S05',gasname='CH4',gasvalue='${ch4}',remarks='ok' where SID='S05'and gasname='CH4'`;
            con.query(query2, (err, result2) => {
            if (err) throw err;
            console.log(result2);
        });
            const query3 = `UPDATE pollution.s05day SET SID='S05',gasname='CO',gasvalue='${co}',remarks='ok' where SID='S05'and gasname='CO'`;
            con.query(query3, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });

            const query4 = `UPDATE pollution.s05day SET SID='S05',gasname='NH3',gasvalue='${nh3}',remarks='ok' where SID='S05'and gasname='NH3'`;
            con.query(query4, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });
            const query5 = `UPDATE pollution.s05week SET SID='S05',week_day='2023-06-11',gasavgvalue=${x},remarks='ok' where SID='S05' and week_day='2023-05-24'`;
            con.query(query5, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });

           }
          
           else{

            const query = `UPDATE pollution.s05day SET SID='S05',gasname='CO2',gasvalue='${co2}',remarks='warning' where SID='S05'and gasname='CO2'`;
            con.query(query, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });
            const query2 =  `UPDATE pollution.s05day SET SID='S05',gasname='CH4',gasvalue='${ch4}',remarks='warning' where SID='S05'and gasname='CH4'`;
            con.query(query2, (err, result2) => {
            if (err) throw err;
            console.log(result2);
        });
            const query3 = `UPDATE pollution.s05day SET SID='S05',gasname='CO',gasvalue='${co}',remarks='warning' where SID='S05'and gasname='CO'`;
            con.query(query3, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });

            const query4 = `UPDATE pollution.s05day SET SID='S05',gasname='NH3',gasvalue='${nh3}',remarks='warning' where SID='S05'and gasname='NH3'`;
            con.query(query4, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });
            const query5 = `UPDATE pollution.s05week SET SID='S05',week_day='2023-05-24',gasavgvalue='${x}',remarks='warning' where SID='S05' `;
            con.query(query5, (err, result1) => {
            if (err) throw err;
            console.log(result1);
        });

           } 
           
}
    
            }    

   

   
    res.send();
})

app.listen(3030, () => {
    console.log(`http://localhost:3030`);
})