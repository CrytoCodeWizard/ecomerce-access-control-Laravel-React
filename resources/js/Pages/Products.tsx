import React, { useEffect, useState } from "react";

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';

import axios from "axios";

const Products = ({ auth }: PageProps) => {
    const [products, setproducts] = useState([]);

    useEffect(() => {
        axios.get("api/products")
            .then(response => {
                setproducts(response.data);
            })
    }, []);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Products</h2>}>
            <Head title="Products" />
            <div className="py-12">
                
            </div>
            {
                products.map(product => (
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8" key={ product.id }>
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-6 text-gray-900">{ product.name }</div>
                            <span className="p-6 text-gray-900">{ product.price }</span>
                        </div>
                    </div>
                ))
            }
        </AuthenticatedLayout>
    )
}

export default Products;