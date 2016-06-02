var portalApp = angular.module("portalApp",[]);

portalApp.controller('portalController', ['$scope', '$http', '$filter', function($scope, $http, $filter) {
    'use strict';
    
    var vm = this;
    vm.data= {};
    
    function getData(params, target, callback) {
        $http({
            method: 'GET',
            url: 'connect.php',
            params: params
        }).then(function successCallback(response) {
            callback(target, response.data);
            
        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
        });
    }

    function getCats() {
        var params = {};
        params.table = "Categories";
        params.sort_field = "Order";
        params.sort_dir = "ASC";
        getData(params, vm.data, buildCats);
    };
    function buildCats(target, data) {
        var empty = data.shift();// move the 'empty' links (links w/ no category) to the end
        data.push(empty);
        vm.data = data;
        $.each(vm.data,function(index, catObj){
            getUnGroupedLinks(catObj);
            getSubCats(catObj);
        });
    };
        
    function getSubCats(categoryObject) {
        var params = {};
        params.table = "SubCats";
        params.where_field = "Category";
        params.where_value = categoryObject.uID;
        params.sort_field = "Order";
        params.sort_dir = "ASC";
        getData(params, categoryObject, buildSubCats);
    };
    function buildSubCats(categoryObject, data) {
        categoryObject.SubCats = data;
        $.each(categoryObject.SubCats,function(index, subCatObj){
            getLinks(subCatObj);
        });
    };
    
    function getUnGroupedLinks(categoryObject){
        var params = {};
        params.table = "Links";
        params.where_field = "Category";
        params.where_value = categoryObject.uID;
        params.and = "SubCat IS NULL"
        params.sort_field = "Order";
        params.sort_dir = "ASC";
        getData(params, categoryObject, buildUnGroupedLinks);
    };
    function buildUnGroupedLinks(categoryObject, data){
        categoryObject.Links = data;
    };
    
    function getLinks(subCatObj){
        var params = {};
        params.table = "Links";
        params.where_field = "SubCat";
        params.where_value = subCatObj.uID;
        params.sort_field = "Order";
        params.sort_dir = "ASC";
        getData(params, subCatObj, buildLinks);
    };
    function buildLinks(subCatObject, data){
        subCatObject.Links = data;
    };

    function init(){
        getCats();
    }
    
    init();
    
}]);