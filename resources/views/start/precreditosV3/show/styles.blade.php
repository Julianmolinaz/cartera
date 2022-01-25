<style>
    .obligacion-container {
        display: grid;
        margin-bottom: 40px;
        grid-template-areas: "productos solicitud credito";
        grid-template-columns: 1fr 400px 1fr;
        gap: 20px;
        width: 100%;
        justify-content: center;
    }
    
    @media (max-width:1300px) {
        .obligacion-container {
            grid-template-columns: 350px 400px 350px;
        }
    }
    @media (max-width:600px) {
        
        .obligacion-container {
            grid-template-columns: 350px 400px 250px;
        }
    }
    @media (max-width:900px) {
        
        .obligacion-container {
            grid-template-areas: "solicitud"
                                 "credito"
                                 "productos";
            grid-template-columns: 1fr;
            padding: 0; 
        }
        .card-credito__no-actives {
            padding-top: 30px;
        }
    }


    .card-productos, .card-solicitud, .card-credito
    {
        background-color: #ffffff;
        padding-bottom: 30px;
    }
    .card-productos {
        min-width: 300px;
        grid-area: productos;
    }
    .card-header {
        display: flex;
        flex-direction: column;
        gap: 4px;
        background-color: #313030;
        border-radius: 4px 4px 0 0;
        padding: 10px;
    }
    .card-title {
        font-size: 16px;
        color: #ffffff;
        font-weight: 400;
    }
    .card-solicitud {
        grid-area: solicitud;
        min-width: 300px;
    }
    .card-credito {
        grid-area: credito;
    }
    .my-btn {
        border: none;
    }
    .card-content {
        height: 850px;
        overflow: scroll;
        overflow-x: hidden;
    }
    .card-content::-webkit-scrollbar { 
        scrollbar-width: none;
        display: none; 
    }
    .card-content__item {
        display: flex;
        gap: 7px;
        padding: 10px;
    }
    .card-content__item:not(:last-child) {
        border-bottom: 1px solid #E5E5E5;
    }
    .card-content__subitem {
        width: 33.3%;
    }
    .card-content__subitem-title {
        font-weight: 600;
    }
    .card-content__subitem-line {
        width: 100%;
        display: grid;
        grid-template-columns: 50% 50%;
    }
    .pg-tag {
        font-size: 11px;
        padding: 3px 4px;
        color: #fff;
        font-weight: 600;
        border-radius: 4px;
    }
    .pg-tag--primary {
        background-color: #0982ed;
    }
    .pg-tag--danger {
        background-color: red;
    }
    .pg-tag--default {
        background-color: #838383;
    }
    .pg-tag--flow {
        background-color: #ffc300;
    }
    .card-credito__no-active {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card-credito__btn-activate {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: #333;
        gap: 10px;    
    }
    .card-credito-icon-off {
        font-size: 30px;
    }
    .card-credito__no-active a {
        text-decoration: none;
    }
    .sanciones-content {
        display: flex;
        font-size: 12px;
        gap: 5px;
    }
    .sanciones-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .sanciones-concept {
        font-weight: 500;
    }
</style>