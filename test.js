function output(message){
    document.getElementById("test").innerHTML = message;
}

var person = {
    name: "",
    age: 0,
    greeting: function(){
        output("Hello, my name is " + this.name + " and I am " + this.age + " years old");
    }
};

person.name = "Sherif";
person.age = 17;
person.greeting();