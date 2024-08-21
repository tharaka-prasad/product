import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';

export default function Dashboard({ auth }: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-black-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="dashboard-background min-h-screen">
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-10 text-3xl text-center  text-black-500 font-bold"> 😍 ............පුංචි අපේ සෙල්ලම් බඩු කඩේ.........😍  </div>
                            <div className="p-10 text-3xl text-center text-black-500 font-bold"> 😍 ............Little our toy shop.................😍 </div>
                            <div className="p-10 text-3xl text-center  text-black-500 font-bold"> 😍 .............எங்கள் சிறிய பொம்மை கடை... 😍  </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
