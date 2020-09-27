 
 function getProductos(producto)
 {
     switch (producto.id) {
        case 1:
            return [new Producto(producto.id, 'R.T.M')];
            break;  
        case 2: 
            return [new Producto(producto.id, 'SOAT')];   
            break; 
        case 3: 
            return [new Producto(producto.id, 'SOAT'), 
                    new Producto(producto.id, 'R.T.M')]
            break;        
        case 13:
            return [new Producto(producto.id, 'SOAT'), 
                    new Producto(producto.id, 'SOAT')]
            break;
        case 14:
            return [new Producto(producto.id, 'R.T.M'),
                    new Producto(producto.id, 'R.T.M')]
            break;        
    
        default:
            return false;
            break;
     }
 }