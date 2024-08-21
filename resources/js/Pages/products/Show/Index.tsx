import React from 'react';
import { usePage, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Show() {
    const { auth, product }: any = usePage().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-black-800 leading-tight">Product Details</h2>}
        >
            <Head title="Product Details" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h3 className="text-lg font-medium">Product Name: {product.name}</h3>
                            <p className="mt-4">Description: {product.description}</p>
                            <p className="mt-4">Price: {product.price}</p>

                            {/* Handle case where category might not be loaded */}
                            {product.category ? (
                                <p className="mt-4">Category: {product.category.name}</p>
                            ) :
                            (
                                <p className="mt-4">Category is available : {product.status}</p>
                            )}
                            {product.image && (
                                <img
                                    src={`/storage/${product.image}`}
                                    alt={product.name}
                                    className="mt-4 w-64 h-64 object-cover"
                                />
                            )}

                            <Link
                                href={route('products.index')}
                                className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            >
                                Back to Products
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
