# `Prototype`

Also known as: Clone

## Niyet 
**Prototip, kodunuzu sınıflarına bağımlı hale getirmeden mevcut nesneleri kopyalamanıza olanak tanıyan yaratıcı bir tasarım modelidir.**

![alt text](https://refactoring.guru/images/patterns/content/prototype/prototype.png "Prototype")

## Sorun 

Diyelim ki bir nesneniz var ve onun tam bir kopyasını oluşturmak istiyorsunuz. Nasıl yapardın? İlk olarak, aynı sınıftan yeni bir nesne oluşturmalısınız. Ardından, orijinal nesnenin tüm alanlarını gözden geçirmeniz ve değerlerini yeni nesneye kopyalamanız gerekir. 

Güzel! Ama bir sorun var. Nesnenin bazı alanları özel olabileceğinden ve nesnenin dışından görünmeyebileceğinden, tüm nesneler bu şekilde kopyalanamaz.

![alt text](https://refactoring.guru/images/patterns/content/prototype/prototype-comic-1-en.png "Prototype")
> Bir nesneyi "dışarıdan" kopyalamak her zaman mümkün değildir.

Doğrudan yaklaşımla ilgili bir sorun daha var. Bir kopya oluşturmak için nesnenin sınıfını bilmeniz gerektiğinden, kodunuz o sınıfa bağımlı hale gelir. Ekstra bağımlılık sizi korkutmuyorsa, başka bir sorun daha var. Bazen, örneğin bir yöntemdeki bir parametre bazı arabirimleri izleyen herhangi bir nesneyi kabul ettiğinde, yalnızca nesnenin izlediği arabirimi bilirsiniz, somut sınıfını bilmezsiniz.

## Çözüm 
Prototip modeli, klonlama sürecini klonlanmakta olan gerçek nesnelere devreder. Model, klonlamayı destekleyen tüm nesneler için ortak bir arabirim bildirir. Bu arabirim, kodunuzu o nesnenin sınıfına bağlamadan bir nesneyi klonlamanıza izin verir. Genellikle, böyle bir arabirim yalnızca tek bir klonlama yöntemi içerir.

Klon yönteminin uygulanması tüm sınıflarda çok benzerdir. Yöntem, geçerli sınıftan bir nesne oluşturur ve eski nesnenin tüm alan değerlerini yenisine taşır. Özel alanları(private) bile kopyalayabilirsiniz çünkü çoğu programlama dili, nesnelerin aynı sınıfa ait diğer nesnelerin özel alanlarına erişmesine izin verir.

Klonlamayı destekleyen bir nesneye prototip denir. Nesneleriniz düzinelerce alana ve yüzlerce olası konfigürasyona sahip olduğunda, bunları klonlamak, alt sınıflandırmaya bir alternatif olarak hizmet edebilir.

![alt text](https://refactoring.guru/images/patterns/content/prototype/prototype-comic-2-en.png "Prototype")
> Önceden oluşturulmuş prototipler, alt sınıflandırmaya bir alternatif olabilir.

İşte böyle çalışır: çeşitli şekillerde yapılandırılmış bir dizi nesne yaratırsınız. Konfigüre ettiğiniz gibi bir nesneye ihtiyacınız olduğunda, sıfırdan yeni bir nesne oluşturmak yerine bir prototipi klonlamanız yeterlidir.

# Gerçek Dünya Analojisi

Gerçek hayatta prototipler, bir ürünün seri üretimine başlamadan önce çeşitli testler yapmak için kullanılır. Ancak bu durumda prototipler herhangi bir gerçek üretime katılmaz, bunun yerine pasif bir rol oynar.

![alt text](https://refactoring.guru/images/patterns/content/prototype/prototype-comic-2-en.png "Prototype")
> Bir hücrenin bölünmesi.

Endüstriyel prototipler kendilerini gerçekten kopyalamadıkları için, kalıba çok daha yakın bir benzetme, mitotik hücre bölünmesi sürecidir (biyoloji, hatırladın mı?). Mitotik bölünmeden sonra, bir çift özdeş hücre oluşur. Orijinal hücre bir prototip görevi görür ve kopyanın oluşturulmasında aktif rol alır.

## Structure
Basic implementation

![alt text](https://refactoring.guru/images/patterns/diagrams/prototype/structure.png "Prototype")

1. Prototip arabirimi, klonlama yöntemlerini bildirir. Çoğu durumda, tek bir klonlama yöntemidir.
2. Concrete Prototype sınıfı, klonlama yöntemini uygular. Bu yöntem, orijinal nesnenin verilerini klona kopyalamanın yanı sıra bağlantılı nesnelerin klonlanması, yinelemeli bağımlılıkların çözülmesi vb. ile ilgili klonlama işleminin bazı uç durumlarını da işleyebilir.
3. Client, prototip arayüzünü takip eden herhangi bir nesnenin bir kopyasını üretebilir.

## Prototype registry implementation

![alt text](https://refactoring.guru/images/patterns/diagrams/prototype/structure-prototype-cache.png "Prototype")

Prototip Kaydı, sık kullanılan prototiplere kolay erişim sağlar. Kopyalanmaya hazır, önceden oluşturulmuş bir dizi nesneyi depolar. 
En basit prototip kaydı, bir name → prototype hash map dir. Ancak, basit bir addan daha iyi arama ölçütlerine ihtiyacınız varsa, kayıt defterinin çok daha sağlam bir sürümünü oluşturabilirsiniz.

## Sözde kod 
Bu örnekte, Prototip deseni, kodu sınıflarıyla eşleştirmeden geometrik nesnelerin tam kopyalarını oluşturmanıza olanak tanır.

![alt text](https://refactoring.guru/images/patterns/diagrams/prototype/example.png "Prototype")

> Bir sınıf hiyerarşisine ait olan bir dizi nesneyi klonlama.

Tüm şekil sınıfları, bir klonlama yöntemi sağlayan aynı arayüzü takip eder. Bir alt sınıf, kendi alan değerlerini nihai nesneye kopyalamadan önce ebeveynin klonlama yöntemini çağırabilir.

```java

// Base prototype.
abstract class Shape is
    field X: int
    field Y: int
    field color: string

    // A regular constructor.
    constructor Shape() is
        // ...

    // The prototype constructor. A fresh object is initialized
    // with values from the existing object.
    constructor Shape(source: Shape) is
        this()
        this.X = source.X
        this.Y = source.Y
        this.color = source.color

    // The clone operation returns one of the Shape subclasses.
    abstract method clone():Shape


// Concrete prototype. The cloning method creates a new object
// in one go by calling the constructor of the current class and
// passing the current object as the constructor's argument.
// Performing all the actual copying in the constructor helps to
// keep the result consistent: the constructor will not return a
// result until the new object is fully built; thus, no object
// can have a reference to a partially-built clone.
class Rectangle extends Shape is
    field width: int
    field height: int

    constructor Rectangle(source: Rectangle) is
        // A parent constructor call is needed to copy private
        // fields defined in the parent class.
        super(source)
        this.width = source.width
        this.height = source.height

    method clone():Shape is
        return new Rectangle(this)


class Circle extends Shape is
    field radius: int

    constructor Circle(source: Circle) is
        super(source)
        this.radius = source.radius

    method clone():Shape is
        return new Circle(this)


// Somewhere in the client code.
class Application is
    field shapes: array of Shape

    constructor Application() is
        Circle circle = new Circle()
        circle.X = 10
        circle.Y = 10
        circle.radius = 20
        shapes.add(circle)

        Circle anotherCircle = circle.clone()
        shapes.add(anotherCircle)
        // The `anotherCircle` variable contains an exact copy
        // of the `circle` object.

        Rectangle rectangle = new Rectangle()
        rectangle.width = 10
        rectangle.height = 20
        shapes.add(rectangle)

    method businessLogic() is
        // Prototype rocks because it lets you produce a copy of
        // an object without knowing anything about its type.
        Array shapesCopy = new Array of Shapes.

        // For instance, we don't know the exact elements in the
        // shapes array. All we know is that they are all
        // shapes. But thanks to polymorphism, when we call the
        // `clone` method on a shape the program checks its real
        // class and runs the appropriate clone method defined
        // in that class. That's why we get proper clones
        // instead of a set of simple Shape objects.
        foreach (s in shapes) do
            shapesCopy.add(s.clone())

        // The `shapesCopy` array contains exact copies of the
        // `shape` array's children.

```

## Uygulanabilirlik

**Kodunuzun kopyalamanız gereken somut nesne sınıflarına bağlı olmaması gerektiğinde Prototip modelini kullanın.**

Bu, kodunuz bazı arabirimler aracılığıyla 3. taraf kodundan size iletilen nesnelerle çalıştığında çok olur. Bu nesnelerin somut sınıfları bilinmiyor ve isteseniz bile onlara güvenemezsiniz.

Prototip kalıbı, müşteri koduna klonlamayı destekleyen tüm nesnelerle çalışmak için genel bir arayüz sağlar. Bu arabirim, istemci kodunu klonladığı somut nesne sınıflarından bağımsız kılar.

**Yalnızca ilgili nesnelerini başlatma biçimleri bakımından farklılık gösteren alt sınıfların sayısını azaltmak istediğinizde deseni kullanın.**

Kullanılabilmesi için zahmetli bir yapılandırma gerektiren karmaşık bir sınıfınız olduğunu varsayalım. Bu sınıfı yapılandırmanın birkaç yaygın yolu vardır ve bu kod, uygulamanıza dağılmıştır. Çoğaltmayı azaltmak için birkaç alt sınıf oluşturursunuz ve her ortak konfigürasyon kodunu kurucularına koyarsınız. Çoğaltma problemini çözdünüz, ancak şimdi bir sürü yapay alt sınıfınız var.

Prototip deseni, çeşitli şekillerde prototip olarak yapılandırılmış bir dizi önceden oluşturulmuş nesneyi kullanmanıza izin verir. İstemci, bazı konfigürasyonlarla eşleşen bir alt sınıfı başlatmak yerine, uygun bir prototipi arayabilir ve onu klonlayabilir.

## Nasıl Uygulanır?

1. Prototip arayüzünü oluşturun ve içindeki klonlama yöntemini bildirin. Veya, eğer varsa, mevcut bir sınıf hiyerarşisinin tüm sınıflarına yöntemi ekleyin.

2. Bir prototip sınıfı, o sınıfın bir nesnesini bağımsız değişken olarak kabul eden alternatif oluşturucuyu tanımlamalıdır. Yapıcı, sınıfta tanımlanan tüm alanların değerlerini geçirilen nesneden yeni oluşturulan örneğe kopyalamalıdır. Bir alt sınıfı değiştiriyorsanız, özel alanlarının klonlanmasını üst sınıfın halletmesine izin vermek için üst yapıcıyı çağırmalısınız.

Programlama diliniz yöntem aşırı yüklemesini desteklemiyorsa, ayrı bir "prototip" oluşturucu oluşturamazsınız. Bu nedenle, nesnenin verilerinin yeni oluşturulan klona kopyalanması, clone yöntemi içinde gerçekleştirilmelidir. Yine de, bu kodu normal bir oluşturucuda bulundurmak daha güvenlidir çünkü ortaya çıkan nesne, siz yeni işleci çağırdıktan hemen sonra tam olarak yapılandırılmış olarak döndürülür.

3. Klonlama yöntemi genellikle tek bir satırdan oluşur: yapıcının prototip versiyonuyla yeni bir işleç çalıştırmak. Her sınıfın, klonlama yöntemini açıkça geçersiz kılması ve new işleciyle birlikte kendi sınıf adını kullanması gerektiğini unutmayın. Aksi takdirde, klonlama yöntemi bir üst sınıfın nesnesini üretebilir.

4. İsteğe bağlı olarak, sık kullanılan prototiplerin bir kataloğunu depolamak için merkezi bir prototip kaydı oluşturun.

Kayıt defterini yeni bir fabrika sınıfı olarak uygulayabilir veya prototipi getirmek için statik bir yöntemle temel prototip sınıfına koyabilirsiniz. Bu yöntem, müşteri kodunun yönteme ilettiği arama ölçütlerine dayalı olarak bir prototip aramalıdır. Kriterler, basit bir dize etiketi veya karmaşık bir arama parametreleri kümesi olabilir. Uygun prototip bulunduktan sonra, kayıt defteri onu klonlamalı ve kopyayı müşteriye iade etmelidir.

Son olarak, alt sınıfların oluşturucularına yapılan doğrudan çağrıları, prototip kayıt defterinin fabrika yöntemine yapılan çağrılarla değiştirin.

## Yararları ve Zararları

### Yararları

- Nesneleri somut sınıflarına bağlamadan klonlayabilirsiniz. 
- Önceden oluşturulmuş prototipleri klonlamak için tekrarlanan başlatma kodundan kurtulabilirsiniz. 
- Karmaşık nesneleri daha rahat üretebilirsiniz. 
- Karmaşık nesneler için yapılandırma hazır ayarlarıyla uğraşırken devralmaya bir alternatif elde edersiniz.

### Zararları

- Dairesel referansları olan karmaşık nesneleri klonlamak çok zor olabilir.

## Diğer Kalıplarla İlişkiler

- Many designs start by using Factory Method (less complicated and more customizable via subclasses) and evolve toward Abstract Factory, Prototype, or Builder (more flexible, but more complicated).
- Soyut Fabrika sınıfları genellikle bir dizi Fabrika Yöntemine dayalıdır, ancak bu sınıflardaki yöntemleri oluşturmak için Prototip'i de kullanabilirsiniz.
- Prototype can help when you need to save copies of Commands into history.
-  Composite and Decorator yoğun şekilde yararlanan tasarımlar, genellikle Prototip kullanmaktan faydalanabilir. Deseni uygulamak, karmaşık yapıları sıfırdan yeniden oluşturmak yerine klonlamanıza olanak tanır.
- Prototip kalıtıma dayalı değildir, dolayısıyla dezavantajları yoktur. Öte yandan Prototip, klonlanan nesnenin karmaşık bir şekilde başlatılmasını gerektirir. Fabrika Yöntemi kalıtıma dayalıdır ancak bir başlatma adımı gerektirmez. Bu nedenle, Fabrika Yöntemi, Prototip'e göre daha kolay uygulanabilir.
- Bazen Prototip, Memento'ya daha basit bir alternatif olabilir. Bu, durumunu geçmişte saklamak istediğiniz nesne oldukça basitse ve dış kaynaklara bağlantıları yoksa veya bağlantıların yeniden kurulması kolaysa işe yarar.
- Abstract Factories, Builders and Prototypes can all be implemented as Singletons.



