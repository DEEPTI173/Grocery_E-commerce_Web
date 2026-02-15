const vegetables = [
    {id:101, name:"Spinach" , price:50 , img:"asset/spinach.jpg" , unit:"per Bunch"},
    {id:102, name:"Tomato" , price:40 , img:"asset/tomato.jpg " , unit:"per Kg"},
    {id:103, name:"Potato" , price:32 , img:"asset/potato.jpg" , unit:"per Kg"},
    {id:104, name:"Onion" , price:35 , img:"asset/onion.jpg" , unit:"per Kg"},
    {id:105, name:"Carrot" , price:25 , img:"asset/carrot.jpg" , unit:"per Kg"},
    {id:106, name: "Cabbage" , price:30 , img:"asset/cabbage.jpg" , unit:"per Unit"},
    {id:107,name:"Capsicum" , price:60 , img:"asset/capsicum.jpg" , unit:"per 3-Unit"},
    {id:108,name:"Peas" , price:55 , img:"asset/pea.jpg" , unit:"per Kg"},
    {id:109,name:"Coriander" , price:20 , img:"asset/coriander.jpg" , unit:"per Bunch"},
    {id:110, name:"Green Chilly" , price:125 , img:"asset/greenchilly.jpg" , unit:"per Kg"},
    {id:164, name:"Cauliflower", price:40, img:"asset/cauliflower.jpg", unit:"per Unit"},
    {id:165, name:"Bottle Guard", price:25, img:"asset/bottleguard.jpg", unit:"per Kg"} 
];
const fruits = [
    {id:111, name:"Apple" , price:120 , img:"asset/apple.jpg" , unit:"per Kg"},
    {id:112, name:"Mango" , price:150 , img:"asset/mango.jpg" , unit:"per Kg"},
    {id:113, name:"Banana" , price:50 , img:"asset/banana.jpg" , unit:"per Dozen"},
    {id:114, name:"Orange" , price:80 , img:"asset/oranges.jpg" , unit:"per Kg"},
    {id:115, name:"Grapes" , price:90 , img:"asset/grapes.jpg" , unit:"per Kg"},
    {id:116, name:"Pineapple" , price:50 , img:"asset/pineapple.jpg" , unit:"per Unit"},
    {id:117, name:"Pomegranate" , price:160 , img:"asset/pomegrante.jpg" , unit:"per Kg"},
    {id:118, name:"Strawberry" , price:220 , img:"asset/strawberry.jpg" , unit:"per Kg"},
    {id:119, name:"Pear" , price:130 , img:"asset/pear.jpg" , unit:"per Kg"},
    {id:120, name:"Guava" , price:70 , img:"asset/gauva.jpg" , unit:"per Kg"},
    {id:166, name:"Watermelon", price:40, img:"asset/watermelon.jpg", unit:"per Unit"},
    {id:167, name:"Dragon Fruit", price:220, img:"asset/dragonfruit.jpg", unit:"per Kg"}
];
const diary =[
    {id:121, name:"Milk", price:40, img:"asset/milk.jpg", unit:"per Packet"},
    {id:122, name:"Curd", price:45, img:"asset/curd.jpg", unit:"per Packet"},
    {id:123, name:"Cheese", price:320, img:"asset/paneer.jpg", unit:"per Kg"},
    {id:124, name:"Creame", price:70, img:"asset/creame.jpg", unit:"per Packet"},
    {id:161, name:"Butter", price:110, img:"asset/butter.jpg", unit:"per Packet"},
    {id:125, name:"Egg", price:50, img:"asset/egg.jpg", unit:"per Tray"}
];
const breakfast =[
    {id:126, name:"Bread", price:20, img:"asset/bread.jpg", unit:"per Packet"},
    {id:127, name:"Busicuit", price:10, img:"asset/busicuit.jpg", unit:"per Packet"},
    {id:128, name:"Nuts", price:48, img:"asset/nuts.jpg", unit:"per Packet"},
    {id:129, name:"Oats", price:65, img:"asset/oats.jpg", unit:"per Packet"},
    {id:130, name:"Cookies", price:30, img:"asset/cookies.jpg", unit:"per Packet"},
    {id:168, name:"Peanut Butter", price:320, img:"asset/peanutbutter.jpg", unit:"per Box"}
];
const frozen =[
    {id:131, name:"Macronni", price:68, img:"asset/macronni.jpg", unit:"per Packet"},
    {id:132, name:"Maggie", price:24, img:"asset/maggie.jpg", unit:"per Packet"},
    {id:133, name:"Noodles", price:32, img:"asset/noodles.jpg", unit:"per Packet"},
    {id:134, name:"Pasta", price:55, img:"asset/pasta.jpg", unit:"per Packet"},
    {id:135, name:"Maggie_Masala", price:5, img:"asset/maggiemasala.jpg", unit:"per Packet"},
    {id:169, name:"Korean Noodles", price:50, img:"asset/koreannoodles.jpg", unit:"per Pack"}
];
const Snacks =[
    {id:136, name:"Namkeen", price:20, img:"asset/namkeen1.jpg", unit:"per Packet"},
    {id:137, name:"Popcorn", price:15, img:"asset/popcorn.jpg", unit:"500 gm"},
    {id:138, name:"Kurkure", price:5, img:"asset/kurkure.jpg", unit:"per Packet"},
    {id:139, name:"Chips", price:20, img:"asset/Snacks_chips.jpg", unit:"per 4-Combo"},
    {id:140, name:"Nut Cracker", price:10, img:"asset/nutcracker.jpg", unit:"per Packet"},
    {id:170, name:"Mad Angles", price:5, img:"asset/madangles.jpg", unit:"per Packet"}
];
const beverages = [
    {id:141, name:"Orange_Juice", price:70, img:"asset/juice1.jpg", unit:"per Bottle"},
    {id:142, name:"Pomegranate_Juice", price:80, img:"asset/juices.jpg", unit:"per Bottle"},
    {id:143, name:"Maha Pack Juices", price:250, img:"asset/juices2.jpg", unit:"per 3-Bottle"},
    {id:144, name:"Fanta", price:60, img:"asset/colddrink3.jpg", unit:"per Bottle"},
    {id:145, name:"Sprite", price:70, img:"asset/coldrink2.jpg", unit:"per Bottle"},
    {id:171, name:"Maaza", price:80, img:"asset/maaza.jpg" , unit:"per Bottle"}
];
const Sweet = [
    {id:146, name:"Cake", price:20, img:"asset/cake.jpg", unit:"per Packet"},
    {id:147, name:"Chocolate", price:60, img:"asset/chocolate2.jpg", unit:"per Unit"},
    {id:148, name:"Toofee", price:40, img:"asset/toofee.jpg", unit:"per Packet"},
    {id:149, name:"Donut", price:25, img:"asset/donut.jpg", unit:"per Packet"},
    {id:150, name: "Busicuit", price:10, img:"asset/busicuit1.jpg", unit:"per Packet"},
    {id:172, name:"Gems", price:10, img:"asset/gems.jpg", unit:"per Packet"}
];
const cooking = [
    {id:151, name:"Water", price:30, img:"asset/water.jpg", unit:"per Bottle"},
    {id:152, name:"Sunflower_oil", price:90, img:"asset/sunfloweroil.jpg", unit:"per Bottle"},
    {id:153, name:"Mustard_oil", price:55, img:"asset/mustardoil.jpg", unit:"per Bottle"},
    {id:154, name:"Jam", price:35, img:"asset/jam.jpg", unit:"per Bottle"},
    {id:155, name:"Pickel", price:69, img:"asset/pickel.jpg", unit:"per Bottle"},
    {id:156, name:"Ketchup", price:35, img:"asset/ketcup.jpg", unit:"per Packet"},
    {id:157, name:"Tealeaves", price:48, img:"asset/tealeaves.jpg", unit:"per Packet"},
    {id:158, name:"Sugar", price:45, img:"asset/sugar.jpg", unit:"per Packet"},
    {id:159, name:"Maha Pack Spices", price:55, img:"asset/spices.jpg", unit:"per Pack"},
    {id:160, name:"Salt", price:45, price:48, img:"asset/salt.jpg", unit:"per packet"},
    {id:162, name:"Beans", price:70, img:"asset/S&P_beans.jpg", unit:"per Packet"},
    {id:163, name:"Soya Chunks", price:40, img:"asset/neutrala.jpg", unit:"per Packet"}
];
function loadProducts(data , elementId ){
    const container = document.getElementById(elementId);

    if (!Array.isArray(data)){
        console.error("Data is not an array:" , data);
        return;
    }

    data.forEach((item) =>{
        container.innerHTML += `
        <div class="card">
            <div class="img-box">
                <img src="${item.img}" alt="${item.name}">
            </div>
            <div class="info">
                <h4>${item.name}</h4>
                <p class="price">₹${item.price} (${item.unit})</p>
                <div class="cart-box">
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="${item.id}">
                        <label>Qty:</label>
                        <input type="number" name="quantity" value="1" min="1" style="width:60px">
                        <button type="submit">Add to Cart</button>
                    </form>    
                <div>   
            </div>
        </div>
        `;
    });
}
document.addEventListener("DOMContentLoaded", () => {
    let slides = document.querySelectorAll(".image-slider img");
    let index = 0;

    setInterval(() => {
        slides[index].classList.remove("active");
        index = (index + 1) % slides.length;
        slides[index].classList.add("active");
    }, 3000);
});
document.addEventListener("DOMContentLoaded", function(){
    const input = document.getElementById("searchInput");
    const resultsBox = document.getElementById("searchResults");
    const productsContainer = document.getElementById("productsContainer");
    const products = [
        {name :"Spinach" , price:50 , image:"asset/spinach.jpg"},
        {name:"Tomato" , price:40 , image:"asset/tomato.jpg "},
        {name:"Potato" , price:32 , image:"asset/potato.jpg"},
        {name:"Onion" , price:35 , image:"asset/onion.jpg"},
        {name:"Carrot" , price:25 , image:"asset/carrot.jpg"},
        {name: "Cabbage" , price:30 , image:"asset/cabbage.jpg"},
        {name:"Capsicum" , price:60 , image:"asset/capsicum.jpg"},
        {name:"Peas" , price:55 , image:"asset/pea.jpg"},
        {name:"Coriander" , price:20 , image:"asset/coriander.jpg"},
        {name:"Green Chilly" , price:125 , image:"asset/greenchilly.jpg"},
        {name:"Cauliflower", price:40, image:"asset/cauliflower.jpg"},
        {name:"Bottle Guard", price:25, image:"asset/bottleguard.jpg"}, 
        {name:"Apple" , price:120 , image:"asset/apple.jpg"},
        {name:"Mango" , price:150 , image:"asset/mango.jpg"},
        {name:"Banana" , price:50 , image:"asset/banana.jpg"},
        {name:"Orange" , price:80 , image:"asset/oranges.jpg"},
        {name:"Grapes" , price:90 , image:"asset/grapes.jpg"},
        {name:"Pineapple" , price:50 , image:"asset/pineapple.jpg"},
        {name:"Pomegranate" , price:160 , image:"asset/pomegrante.jpg"},
        {name:"Strawberry" , price:220 , image:"asset/strawberry.jpg"},
        {name:"Pear" , price:130 , image:"asset/pear.jpg"},
        {name:"Guava" , price:70 , image:"asset/gauva.jpg"},
        {name:"Watermelon", price:40, image:"asset/watermelon.jpg"},
        {name:"Dragon Fruit", price:220, image:"asset/dragonfruit.jpg"},
        {name:"Milk", price:40, image:"asset/milk.jpg"},
        {name:"Curd", price:45, image:"asset/curd.jpg"},
        {name:"Cheese", price:320, image:"asset/paneer.jpg"},
        {name:"Creame", price:70, image:"asset/creame.jpg"},
        {name:"Butter", price:110, image:"asset/butter.jpg"},
        {name:"Egg", price:50, image:"asset/egg.jpg"},
        {name:"Bread", price:20, image:"asset/bread.jpg"},
        {name:"Busicuit", price:10, image:"asset/busicuit.jpg"},
        {name:"Nuts", price:48, image:"asset/nuts.jpg"},
        {name:"Oats", price:65, image:"asset/oats.jpg"},
        {name:"Cookies", price:30, image:"asset/cookies.jpg"},
        {name:"Peanut Butter", price:320, image:"asset/peanutbutter.jpg"},
        {name:"Macronni", price:68, image:"asset/macronni.jpg"},
        {name:"Maggie", price:24, image:"asset/maggie.jpg"},
        {name:"Noodles", price:32, image:"asset/noodles.jpg"},
        {name:"Pasta", price:55, image:"asset/pasta.jpg"},
        {name:"Maggie_Masala", price:5, image:"asset/maggiemasala.jpg"},
        {name:"Korean Noodles", price:50, image:"asset/koreannoodles.jpg"},
        {name:"Namkeen", price:20, image:"asset/namkeen1.jpg"},
        {name:"Popcorn", price:15, image:"asset/popcorn.jpg"},
        {name:"Kurkure", price:5, image:"asset/kurkure.jpg"},
        {name:"Chips", price:20, image:"asset/Snacks_chips.jpg"},
        {name:"Nut Cracker", price:10, image:"asset/nutcracker.jpg"},
        {name:"Mad Angles", price:5, image:"asset/madangles.jpg"},
        {name:"Cake", price:20, image:"asset/cake.jpg"},
        {name:"Chocolate", price:60, image:"asset/chocolate2.jpg"},
        {name:"Toofee", price:40, image:"asset/toofee.jpg"},
        {name:"Donut", price:25, image:"asset/donut.jpg"},
        {name: "Busicuit", price:10, image:"asset/busicuit1.jpg"},
        {name:"Gems", price:10, image:"asset/gems.jpg"}
    ];
    input.addEventListener("input", function(){
        const value = input.value.toLowerCase().trim();
        resultsBox.innerHTML = "";
        if(value === "") return;
        const filtered = products.filter(p =>
            p.name.toLowerCase().includes(value)
        );
        if(filtered.length === 0){
            resultsBox.innerHTML = "<div>No Product found</div>";
            return;
        }
        filtered.forEach(p => {
            const div = document.createElement("div");
            div.className = "search-item";
            div.textContent = p.name;
            div.onclick = function(){
                input.value = p.name;
                resultsBox.innerHTML = "";
                showProduct(p);
            };
            resultsBox.appendChild(div);
        });
    });
    input.addEventListener("keydown", function(e){
        if (e.key === "Enter"){
            const value = input.value.toLowerCase();
            const product = products.find(p =>
                p.name.toLowerCase() === value
            );
            resultsBox.innerHTML = "";
            if (product){
                showProduct(product);
            } else {
                productsContainer.innerHTML = "<p>No product found</p>";
            }
        }
    });
    function showProduct(product){
        productsContainer.innerHTML = `
            <div class="product-card">
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>₹${product.price}</p>
                <button class="info-btn">Information</button>
            </div>
        `;
        document.querySelector(".info-btn").addEventListener("click", () =>{
            Info(product.name);
        });
    }
    function Info(name) {
        alert("Item Exist! Please Scroll down to Buy the item.");
    }
});

loadProducts(vegetables, "vegList");
loadProducts(fruits, "fruitList");
loadProducts(diary, "diaryList");
loadProducts(breakfast, "breakfastList");
loadProducts(frozen, "frozenList");
loadProducts(Snacks, "snacksList");
loadProducts(beverages, "beveragesList");
loadProducts(Sweet, "sweetList");
loadProducts(cooking, "cookingList");