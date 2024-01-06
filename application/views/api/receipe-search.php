<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <style>
        .hide{
            display: none;
        }
    </style>
</head>
<body>
<main class="container">

    <div class="row mt-4 mb-4">


      <div class="col-8">
        <input type="text" class="form-inline form-control" id="searchInput">
      </div>
      <div class="col-4">
        <button id="searchbutton" class="btn btn-danger" onclick="searchBegin();">search</button>
      </div>

    </div>
    <div class="spinner-border hide" id="loading">
      <span class="sr-only"></span>
    </div>
    <div class="row my-4" id="searchResult"> </div>
  </main>
  <script>
  function searchBegin() {
    document.getElementById("loading").setAttribute("class", "spinner-border view");
    let searchText = document.getElementById("searchInput").value;
    console.log('search text', searchText);
    searchApiRequest(searchText);
  }

  async function searchApiRequest(searchText) {
    const APP_ID = '27cf5c0d';
    const APP_KEY = '189fec70a7493a2dff335e3088198524';
    // send us json object
    //The Response object, in turn, does not directly contain the actual JSON response body but is instead a representation of the entire HTTP response.
    let responce = await fetch(`https://api.edamam.com/search?app_id=${APP_ID}&app_key=${APP_KEY}&q=${searchText}`);
    console.log(responce);
    //convert to javascript object
    // to extract the JSON body content from the Response object, we use the json() method, which returns a second promise that resolves with the result of parsing the response body text as JSON.
    let data = await responce.json();
    console.log('Json Object', data);
    useApiData(data);
  }

  function useApiData(data) {

    // console.log(data.hits);
    let list = '';
    for (let item of data.hits) {
      // console.log(JSON.stringify(item.recipe.totalNutrients));
      // item.recipe.totalNutrients.map(nutrients=>nutrients).join("|")
      list += `
            <div class="col-12 col-md-4 mb-4">
            <div class="card">
            <img src="${item.recipe.image}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">${item.recipe.label}</h5>
            
                <p class="card-text"> <p>Health Label</p>  ${item.recipe.healthLabels.map(food => `<span class="mx-1 my-1 badge bg-primary">${food}</span>`).join(" ")}

                <p class="card-text"> <p>Ingredient list</p><ul>  ${item.recipe.ingredientLines.map(ingLine => `<li>${ingLine}</li>`).join("")}</ul>
                    
                </p>
                
            </div>
        </div>
        </div>`;
    }
    document.getElementById("loading").setAttribute("class", "spinner-border hide");
    document.getElementById('searchResult').innerHTML = list;

  }
</script>
</body>
</html>