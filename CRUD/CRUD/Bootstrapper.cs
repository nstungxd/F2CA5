using System;
using Castle.Windsor;
using Castle.MicroKernel.Registration;
using Castle.Windsor.Configuration.Interpreters;
using FX.Core;
using FX.Data;
using NHibernate.Cfg;
using FluentNHibernate.Cfg;
using CRUD.Core.Domain;
using NHibernate;
using System.Reflection;
using CRUD.Core.Mapping;

namespace CRUD
{
    public class Bootstrapper
    {
        private static IWindsorContainer container;
        public static void InitializeContainer()
        {
            try
            {

                // Initialize Windsor
                container = new WindsorContainer(new XmlInterpreter());

                //container = new WindsorContainer(new XmlInterpreter(new ConfigResource("castle")));

                // Inititialize the static Windsor helper class. 
                IoC.Initialize(container);

                // Add ICuyahogaContext to the container.
                container.Register(Component.For<IFXContext>()
                    .ImplementedBy<FXContext>()
                    .Named("FX.context")
                    .LifeStyle.PerWebRequest
                );
            }
            catch (Exception ex)
            {
                throw;
            }
        }

        // linhpn
        public static void InitializeNhibernate()
        {
            try
            {
                NHibernateSessionManager.Instance.CustomConfigHandler = (sessionFactoryConfigPath) =>
                {
                    //Fluently.Configure().Database(MsSqlConfiguration.MsSql2012
                    //                    .ConnectionString(@"Server=" + _SqlDataIP + ";initial catalog=" + _DbName + ";user=" + _LoginName + ";password=" + _LoginPassword + ";")
                    //                    .ShowSql())
                    //                        .Mappings(m => m.FluentMappings.AddFromAssemblyOf<Organization>())
                    //                        .Mappings(m => m.FluentMappings.AddFromAssemblyOf<OrganizationHist>())
                    //                        .Mappings(m => m.FluentMappings.AddFromAssemblyOf<Users>())
                    //                        .Mappings(m => m.FluentMappings.AddFromAssemblyOf<UsersHist>())
                    //                        .Mappings(m => m.FluentMappings.AddFromAssemblyOf<TransactionInfo>())
                    //                        .Mappings(m => m.FluentMappings.AddFromAssemblyOf<TransactionInfoHist>())
                    //                            .BuildSessionFactory();

                    Configuration cfg = new Configuration();
                    cfg.Configure(sessionFactoryConfigPath);
                    cfg = Fluently.Configure(cfg)
                           .Mappings(x => x.FluentMappings.AddFromAssemblyOf<dmBenhVienMap>())
                           .BuildConfiguration();

                    return cfg.BuildSessionFactory();
                };

            }
            catch (Exception ex)
            {
                //throw;
            }
        }
    }
}